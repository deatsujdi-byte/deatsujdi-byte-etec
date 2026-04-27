from os import name
print("Este programa foi feito para auxiliar a gerenciar notas dos seus alunos. ") #Adicionei uma função para iniciar o programa, e um loop para permitir calcular a média de vários alunos sem precisar reiniciar o programa. Também adicionei uma verificação para determinar se o aluno foi aprovado ou reprovado com base na média calculada como pedido no enunciado. # type: ignore

def start():
    print("Comece nos dizendo as notas individuais do aluno: ") #Comecei pedindo para o professor inserir as notas do aluno.

def nota_media(nota1, nota2, nota3):
    return (nota1 + nota2 + nota3) / 3 # Afunção de média é simples, apenas dividir apos a soma de todas as notas (Nesse exemplo, 3 atividades)

if __name__ == "__main__":  
    while True:
        start()
        nota1 = float(input("Nota 1: "))
        nota2 = float(input("Nota 2: "))
        nota3 = float(input("Nota 3: "))
        media = nota_media(nota1, nota2, nota3) # Verificamos se a média do aluno é maior ou igual a 7, se for o aluno é aprovado, se não, ele é reprovado.
        if media >= 7:
            print("O aluno tem a Média:", media, "logo ele foi aprovado.")
        else:
            print("O aluno tem a Média:", media, "logo ele foi reprovado.")
        
        continuar = input("Deseja calcular a média de outro aluno? (sim/nao): ").lower() # Aqui uma simples condicional para verificar se o professor deseja continuar calculando médias, se ele digitar "sim", o programa reinicia, se ele digitar "nao", o programa é encerrado.
        if continuar != 'sim':
            break   

