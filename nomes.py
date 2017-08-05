import json

with open('nomes.json') as f:
    nomes = json.load(f)
nomeF = '"{0}"'
saida = open('nomes_novos.json','w')
l = []
for n in nomes:
    #for n2 in n.split():
    n2 = n.split()[1];
    l.append(nomeF.format(n2.strip()))
saida.write('[' + (','.join(l)) + ']')
saida.close()
