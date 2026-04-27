from os import name
print("Este programa foi feito para auxiliar a gerenciar notas dos seus alunos. ")

def start():
    print("Comece nos dizendo as notas individuais do aluno: ") 

def nota_media(nota1, nota2, nota3):
    return (nota1 + nota2 + nota3) / 3

if __name__ == "__main__":  
    while True:
        start()
        nota1 = float(input("Nota 1: "))
        nota2 = float(input("Nota 2: "))
        nota3 = float(input("Nota 3: "))
        media = nota_media(nota1, nota2, nota3)
        if media >= 7:
            print("O aluno tem a Média:", media, "logo ele foi aprovado.")
        else:
            print("O aluno tem a Média:", media, "logo ele foi reprovado.")
        
        continuar = input("Deseja calcular a média de outro aluno? (sim/nao): ").lower()
        if continuar != 'sim':
            break   

