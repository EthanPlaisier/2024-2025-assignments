import sys

def start_rekenmachine():
    """
    Eenvoudige rekenmachine waarmee gebruikers basisbewerkingen kunnen uitvoeren.
    """
    # Functie om twee getallen op te tellen
    def optellen(a, b):
        return a + b

    # Functie om het tweede getal van het eerste af te trekken
    def aftrekken(a, b):
        return a - b

    # Functie om twee getallen te vermenigvuldigen
    def vermenigvuldigen(a, b):
        return a * b

    # Functie om het eerste getal door het tweede te delen
    # Controleert of delen door nul wordt vermeden
    def delen(a, b):
        if b != 0:
            return a / b
        else:
            return "Fout: Delen door nul is niet toegestaan."

    # Hoofdprogramma loopt continu totdat de gebruiker kiest om te stoppen
    while True:
        try:
            # Geeft de gebruiker een menu van opties
            print("\nWelkom bij de rekenmachine! Kies een bewerking:")
            print("1. Optellen")
            print("2. Aftrekken")
            print("3. Vermenigvuldigen")
            print("4. Delen")
            print("5. Afsluiten")

            # Gebruiker voert zijn keuze in
            keuze = input("Voer je keuze in (1-5): ")

            # Als de gebruiker "5" kiest, wordt het programma afgesloten
            if keuze == "5":
                print("Bedankt voor het gebruiken van de rekenmachine. Tot ziens!")
                break

            # Controleert of de keuze geldig is
            if keuze in ["1", "2", "3", "4"]:
                try:
                    # Vraagt de gebruiker om twee getallen in te voeren
                    getal1 = float(input("Voer het eerste getal in: "))
                    getal2 = float(input("Voer het tweede getal in: "))
                except ValueError:
                    # Geeft een foutmelding als de invoer geen geldig getal is
                    print("Fout: Voer alstublieft een geldig nummer in.")
                    continue

                # Voert de geselecteerde bewerking uit en toont het resultaat
                if keuze == "1":
                    resultaat = optellen(getal1, getal2)
                    print(f"Resultaat: {getal1} + {getal2} = {resultaat}")
                elif keuze == "2":
                    resultaat = aftrekken(getal1, getal2)
                    print(f"Resultaat: {getal1} - {getal2} = {resultaat}")
                elif keuze == "3":
                    resultaat = vermenigvuldigen(getal1, getal2)
                    print(f"Resultaat: {getal1} * {getal2} = {resultaat}")
                elif keuze == "4":
                    resultaat = delen(getal1, getal2)
                    print(f"Resultaat: {getal1} / {getal2} = {resultaat}")
            else:
                # Geeft een foutmelding als de keuze ongeldig is
                print("Fout: Ongeldige keuze. Probeer het opnieuw.")

        except (EOFError, KeyboardInterrupt):
            # Handelt gebruikersonderbrekingen (Ctrl+C of Ctrl+D) netjes af
            print("\nProgramma onderbroken door gebruiker. Tot ziens!")
            sys.exit()

if __name__ == "__main__":
    # Start de rekenmachine
    start_rekenmachine()