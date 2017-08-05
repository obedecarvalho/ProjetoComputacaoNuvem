import string
import json
import random
import requests

url = 'http://www.wjr.eti.br/nameGenerator/index.php?q=200&o=json'

letra = list(string.ascii_lowercase)
usr = 'INSERT INTO usr VALUES ({0}, "{1}", "{2}");'
clube = 'INSERT INTO clube VALUES ({0}, {1}, "{2}", {3}, {4});'
jogador = 'INSERT INTO jogador VALUES ({0}, {1}, "{2}", {3}, {4}, {5});'
amistoso = 'INSERT INTO amistoso VALUES ({0}, {1}, {2},{3});'

#page = requests.get(url)
#nomes = json.loads(page.content.decode())

with open('nomes_novos.json') as f:
    nomes = json.load(f)

saida = open('inserir_postgres.sql','w')
#saida.write('USE fastfoot;\n')
tam = len(nomes)
for id_usr in range(1,11):
    nome_u = letra[id_usr] * 3
    saida.write(usr.format('DEFAULT', nome_u, nome_u) + '\n')
    saida.write(clube.format('DEFAULT', id_usr, nomes[tam-id_usr*20 - 40], 50, id_usr%5 + 1) + '\n')
for id_usr in range(1,11):
    for i in range(20):
        if i in [12, 16]:
            saida.write(jogador.format('DEFAULT', 'null', nomes[id_usr*20 +i - 40], random.randint(3,8), random.randint(2,4), '0') + '\n')
        else:
            saida.write(jogador.format('DEFAULT', id_usr, nomes[id_usr*20 +i - 40], random.randint(1,9), i%4 + 1, '0') + '\n')
    for i in range(5):
        n1 = random.randint(1,10)
        while n1 == id_usr:
            n1 = random.randint(2,11)
        saida.write(amistoso.format('DEFAULT',id_usr, n1, 1) + '\n')












