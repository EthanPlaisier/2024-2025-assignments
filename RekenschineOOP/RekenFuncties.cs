using System;

namespace RekenschineOOP
{
    internal class RekenFuncties
    {
        /// <summary>
        /// Leest één regel van de console in en converteert naar int.
        /// </summary>
        public int LeesGetal()
        {
            string s = Console.ReadLine();
            return Int32.Parse(s);
        }

        public int Add(int a, int b)
        {
            return a + b;
        }

        public int Subtract(int a, int b)
        {
            return a - b;
        }

        public int Multiply(int a, int b)
        {
            return a * b;
        }

        public int Divide(int a, int b)
        {
            if (b == 0)
                throw new DivideByZeroException();
            return a / b;
        }
    }
}
