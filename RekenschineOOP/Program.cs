using System;

namespace RekenschineOOP
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Programma is gestart!\n");

            var rkEngine = new RekenFuncties();

            while (true)
            {
                Console.WriteLine("Wilt u een rekenkundige bewerking uitvoeren op 2 getallen? (j/n)");
                string keuze = Console.ReadLine()?.Trim().ToLower();

                if (keuze != "j") 
                    break;

                Console.WriteLine("\nWelke bewerking wilt u uitvoeren?");
                Console.WriteLine("Optellen       type +");
                Console.WriteLine("Aftrekken      type -");
                Console.WriteLine("Vermenigvuldigen type *");
                Console.WriteLine("Delen          type /");
                Console.Write("Keuze: ");
                string operatie = Console.ReadLine()?.Trim();

                try
                {
                    // Lees beide getallen
                    Console.Write("Voer het eerste getal in: ");
                    int eerste = rkEngine.LeesGetal();

                    Console.Write("Voer het tweede getal in: ");
                    int tweede = rkEngine.LeesGetal();

                    int resultaat;
                    switch (operatie)
                    {
                        case "+":
                            resultaat = rkEngine.Add(eerste, tweede);
                            break;
                        case "-":
                            resultaat = rkEngine.Subtract(eerste, tweede);
                            break;
                        case "*":
                            resultaat = rkEngine.Multiply(eerste, tweede);
                            break;
                        case "/":
                            resultaat = rkEngine.Divide(eerste, tweede);
                            break;
                        default:
                            Console.WriteLine("Onbekende bewerking!");
                            continue;
                    }

                    Console.WriteLine($"Het resultaat is: {resultaat}\n");
                }
                catch (FormatException)
                {
                    Console.WriteLine("Ongeldige invoer – voer alstublieft een geheel getal in.\n");
                }
                catch (DivideByZeroException)
                {
                    Console.WriteLine("Fout: deling door nul is niet toegestaan.\n");
                }
            }

            Console.WriteLine("Programma beëindigd. Tot ziens!");
        }
    }
}
