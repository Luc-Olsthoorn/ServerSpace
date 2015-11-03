#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <inttypes.h>

int main()
{
    double input;
    float actual;
    int n;
    double total;
    printf("please Enter a variable\n");
    scanf("%lf", &input);
    actual = (100 -input);
    printf("%f\n", actual);
    printf("please enter the number of iterations\n");
    scanf("%d", &n);
    for(int i = 0; i<n; i++)
    {
        total+=pow(10, -2*i)*pow(actual, i);
        printf("%.20f\t", pow(10, -2*i)*pow(actual, i));
        printf("%.32f\n", total);
    }


}
