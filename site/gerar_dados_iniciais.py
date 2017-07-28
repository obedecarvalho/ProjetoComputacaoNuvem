import string
import json
import random
import requests

url = 'http://www.wjr.eti.br/nameGenerator/index.php?q=200&o=json'

letra = list(string.ascii_lowercase)
usr = 'INSERT INTO usr VALUES ({0}, "{1}", "{2}");'
clube = 'INSERT INTO clube VALUES ({0}, {1}, "{2}", {3}, {4});'
jogador = 'INSERT INTO jogador VALUES ({0}, {1}, "{2}", {3}, {4});'
amistoso = 'INSERT INTO amistoso VALUES ({0}, {1}, {2},{3});'

#page = requests.get(url)
#nomes = json.loads(page.content.decode())

with open('nomes.json') as f:
    nomes = json.load(f)

saida = open('inserir_mysql.sql','w')
saida.write('USE fastfoot;\n')

for id_usr in range(2,12):
    nome_u = letra[id_usr] * 3
    nome_c = letra[len(letra) -1 - id_usr] * 3
    saida.write(usr.format(id_usr, nome_u, nome_u) + '\n')
    saida.write(clube.format(id_usr, id_usr, nome_c, random.randint(5,10)*10, id_usr%5 + 1) + '\n')
for id_usr in range(2,12):
    for i in range(20):
        saida.write(jogador.format(id_usr*20 + i, id_usr, nomes[id_usr*20 +i - 40], random.randint(1,10), i%4 + 1) + '\n')
    for i in range(5):
        n1 = random.randint(2,11)
        while n1 == id_usr:
            n1 = random.randint(2,11)
        saida.write(amistoso.format('null',id_usr, n1, 1) + '\n')












