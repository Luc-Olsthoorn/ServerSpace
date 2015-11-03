
#include <iostream>
#include    <iomanip>
#include <vector>
using namespace std;
void Eratos( int length, vector<int>&erat);


main()
{
    int length;
    std::vector<int> erat;
    cout << "Please enter to what number you want prime numbers";
    cin >> length; //scans in the number to be entered
    if(length<2||length>300)//tests it size
    {
       cout<< "too big";
       return 0;//closes the program
    }
    Eratos(length, erat);//does the prime # generator
    int s = 0;
    for(int i = 0; i < erat.size(); i++)// prints contents of the vector
    {
         if(s%10==0)// tests if it is the 10th term
         {
             cout << endl; // new line if it is
         }
         cout << setw(5)<< erat[i];//only 5 digits possible
         s++; //counter goes up
    }
}
void Eratos( int length, vector<int>& erat)
{
    for(int i = 0; i<length+1; i++)
    {
        erat.push_back(i+2);//fills the vector with data

    }


    for(int i = 2; i<length; i++)//parses through each element in the vector
    {

        int n = i;
        for(n; n<erat.size(); n+=1)//gives all the values to see if they are multiples of i
        {
                if(erat[n]%erat[i-2]==0 && erat[n]!=i)//tests if it is divisible by i then removes it
                {
                    erat.erase(erat.begin() + n);
                }
        }



    }
}
