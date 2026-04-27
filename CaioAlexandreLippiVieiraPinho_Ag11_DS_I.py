from colorama import Fore, Style
print("Controle dos niveis de agua do reservatorio")
nivel_agua = float(20) #Exemplo de nível de água em porcentagem (pode ser alterado para testar)
if nivel_agua <= 20:
    print(Fore.RED + "Nivel 1: O Reservatorio está em nivel muito baixo (Critico)")
elif nivel_agua > 20 and nivel_agua <= 40:
    print(Fore.YELLOW + "Nivel 2: O Reservatorio está em nivel baixo")
elif nivel_agua > 40 and nivel_agua <= 60:
    print(Fore.GREEN + "Nivel 3: O reservatorio está em nivel médio")
elif nivel_agua > 60 and nivel_agua <= 80:
    print(Fore.CYAN + "Nivel 4: O reservatorio está em nivel alto")
elif nivel_agua > 80:
    print(Fore.BLUE + "Nivel 5: O reservatório está em nivel muito alto (Alerta)")
print(Style.RESET_ALL)
