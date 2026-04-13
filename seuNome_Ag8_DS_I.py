entrevistados = 50
exc = 0
bom = 0
ruim = 0

print("Pesquisa de satisfação no atendimento - TudoWeb")
print(f"Serão coletadas respostas de {entrevistados} entrevistados.")
for i in range(1, entrevistados + 1):
    print(f"Bem vindo entrevistado {i}!")
    nome = input("Diga-nos seu nome: ")
    idade = input("E a sua idade: ")
    while True:
        satisfeito = input("O quão satisfeito você está com o atendimento da TudoWeb? (Digite 1 para Excelente, 2 para Bom, 3 para Ruim): ")
        if satisfeito == "1":
            exc += 1
            break
        elif satisfeito == "2":
            bom += 1
            break
        elif satisfeito == "3":
            ruim += 1
            break
        else:
            print("Opção inválida. Digite 1, 2 ou 3.")

print("\nRESULTADO DA PESQUISA")
print(f"Quantidade de respostas Excelente: {exc}")
print(f"Quantidade de respostas Ruim: {ruim}")
