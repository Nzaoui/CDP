--------------------------------------------------------------------------
	WHAT IS THIS APPLICATION? AND WHO ARE WE?
--------------------------------------------------------------------------
This Application serves the purpose of helping you manage your projects!
It's been made by three students of the University of Bordeaux:
	Team 09 :
	- ELASSAOUI Chaimae
	- REY Emile
	- ZAOUI Naji

	
	
--------------------------------------------------------------------------
	REQUIREMENT:
--------------------------------------------------------------------------
To run the application you need will need a proper environment, We used 
WampServer 3.0.6 (that you can get from : http://www.wampserver.com ). You 
may also need to download "Visual C++ Redistributable for Visual Studio" 
if come across an error : The program can't start because XXXXX.dll is 
missing from your computer...(it is available on the website of Microsoft: 
https://www.microsoft.com) .
Once WampServer is installed, you might have to change the port, since it 
uses the port 80 and it would probably be taken by another Application, to 
do so you have to go to WampServer's icon (in the taskbar) right click >
Tools > Use a different port than 80 > and put for exemple 8080.



--------------------------------------------------------------------------
	GETTING STARTED
--------------------------------------------------------------------------
	I/- The Database:
First of all we need to deploy the Database, and to do so you need a login
and password to access phpmyadmin, we're going to use the SuperUser root to 
create our new user and deploy the database:
	> localhost:8080/phpmyadmin 
	> login="root",password="" 
	> User accounts(Comptes d'utilisateurs) 
	> add new user account (Ajouter un compte d'utilisateur) 
	> Nom d'utilisateur = gestionProjet
	> Nom d'hote :(chose local from the list)
	> Mot de passe = M2-CDP
	> Privileges globaux : Check Données and Structure
	> Executer
Now you have a user with login: gestionProjet and password: M2-CDP. 
When this is done we deploy our database:
	> localhost:8080/phpmyadmin 
	> login="gestionProjet",password="M2-CDP"
	> Import
	> Chose the file: WHERE_YOU_DID_THE_GIT_CLONE/CDP/src/Database/bdd.sql

Congratulations! now you have the database. 

	II/- The Web:
If the www directory of WampServer isn't where you made your git clone, you
have to copy the folder WHERE_YOU_DID_THE_GIT_CLONE/CDP/src/Web/CDP to 
WampServer's www directory (you can access it WampServer's icon > www 
repository).
All you have to do now is go to: localhost:8080/CDP.



--------------------------------------------------------------------------
	CONTACT
--------------------------------------------------------------------------
We hope that you would use our application in your future projects.

We would love to hear your feedback, we're always looking for means to 
evolve our project so if you have any suggestions feel free to inform us, 
and if you come across a bug please report it to us so we could fix it .

Contact Us: team.09.first@gmail.com

We can't wait to hear from you!
 
Cordially, 
Team 09.