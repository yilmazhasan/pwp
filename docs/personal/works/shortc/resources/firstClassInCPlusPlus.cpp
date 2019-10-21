#include<iostream>

using namespace std;


class Student
{
	public:

	char* name;
	char gender;
	int studentID;
	Student();
	Student(char *isim, char cins, int ogrNum);
	~Student();
	void yazdir();
};






Student::Student()
{
	cout << "Student() is called" << endl;
	name = "isi yok";
	gender = ' ';
	studentID = 0;
}

Student::Student(char *isim, char cins, int ogrNum)
{
	cout << "Student(...) is called" << endl;
	name = isim;
	gender = cins;
	studentID = ogrNum;
}
Student::~Student(){
		cout<< "class with name: " << name << " ~Student() is called" << endl;
}

void Student::yazdir()
{
	cout << "name: " << name << endl
			<< "gender: " << gender << endl
			<< "studentID: " << studentID << endl;
}


int main()
{
	Student s1("hasan", 'm', 1679346);
	Student s2;

	s1.yazdir();
	s2.yazdir();


return 0;
}











/*
int main()
{
	int a;

	cin >> a;

	cout << "a: " << a << endl ;

	for(int i = 0; i < 5; i++)
	{
		cout << "Hello world!" << endl;
		
	}

	char *cPtr = new char[20];
	char *cptr2 = (char*) malloc(20*sizeof(char));

	char cArray[20];

	free(cPtr2);
	delete[] cPtr;

}*/