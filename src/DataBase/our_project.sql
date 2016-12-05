USE GestionDeProjet;

SET FOREIGN_KEY_CHECKS = 0;

REPLACE INTO User VALUES
	(1,"Emile","Rey","erey","erey@localhost",SHA2("erey",256)),
	(98,"Chaimae","ELASSAOUI","cela","cela@localhost",SHA2("cela",256)),
	(97,"Naji","ZAOUI","nzao","nzao@localhost",SHA2("nzao",256));

REPLACE INTO Project VALUES
	(99,"Projet de CDP","<p>Bienvenue dans notre projet de CDP.</p>
<p>Nous sommes 3 &#233;tudiants de M2-GL.</p>
<p>Le but de ce projet est la cr&#233;ation d&#145;un site internet permettant la gestion d&#145;un projet avec SCRUM.</p>
<p>Quelques liens :<ul>
<li><a href=&#145;https://github.com/Nzaoui/CDP&#145; rel=&#145;external&#145;>GitHub de Dev</a></li>
<li><a href=&#145;https://github.com/Nzaoui/Cdp_Clean&#145; rel=&#145;external&#145;>GitHub Clean</a></li></ul></p>
","HTML/CSS/PHP/SQL",1);

REPLACE INTO Sprint VALUES
	(97,99,"2016-10-24","2016-11-4"),
	(98,99,"2016-11-7","2016-11-18"),
	(99,99,"2016-11-21","2016-12-02");

REPLACE INTO WorkOn VALUES
	(98,99),
	(97,99);

REPLACE INTO UserStory(id,id_project,id_sprint,description,priority,difficulty,color,commit) VALUES
	(86,99,97,"En tant que visiteur, je souhaite pouvoir cr&#233;er un compte, afin d&#145;avoir acc&#232;s &#224; plus de fonctionnalit&#233;.",1,1,"#66CC99","02de7b1485922fe295db8ff71a7bda28231d83fd"),
	(87,99,97,"En tant que visiteur, je souhaite pouvoir m&#145;identifier, afin d&#145;acc&#233;der &#224; ma page personnelle.",4,1,"#22CC99","8dfb119939dc989d16599c324936ade137ae6c0a"),
	(88,99,97,"En tant qu&#145;utilisateur, je souhaite pouvoir lister les projets existants, afin de les consulter.",4,1,"#66CA19","8dfb119939dc989d16599c324936ade137ae6c0a"),
	(89,99,98,"En tant qu&#145;utilisateur, je souhaite pouvoir visualiser les d&#233;tails d&#145;un projet, afin de voir son &#233;tat.",4,2,"#6B7C99","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(90,99,98,"En tant que d&#233;veloppeur, je souhaite pouvoir modifier les informations de mon profil, afin de le mettre &#224; jour.",4,1,"#668599","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(91,99,97,"En tant que d&#233;veloppeur, je souhaite visualiser facilement les projets sur lesquelles je travaille, afin de les consulter rapidement.",1,1,"#6F2C99","c846a71d0963a95d4a4800c29869888dfc7e6f90"),
	(92,99,97,"En tant que d&#233;veloppeur, je souhaite pouvoir cr&#233;er un projet, afin de le d&#233;finir. ",1,1,"#66B899","502e72a171d71e9794b55bd06b2080d0404be240"),
	(93,99,98,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir inviter d&#145;autres d&#233;veloppeurs au projet, afin qu&#145;ils puissent manager le projet avec moi.",1,1,"#612C99","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(94,99,98,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir ajouter/supprimer une US et l&#145;affecter &#224; un sprint, afin de mieux d&#233;finir le projet",2,1,"#6FB799","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(95,99,98,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir cr&#233;er un sprint afin de faire avancer le projet.",3,1,"#6F2479","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(96,99,99,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir ajouter une t&#226;che &#224; un sprint, afin de le d&#233;finir.",3,1,"#6F2289","c3dd91f3f93664e3187dd6cec819e4462a6ce61b"),
	(97,99,99,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir m&#145;affecter &#224; une t&#226;che d&#145;un sprint, afin de travailler dessus.",3,1,"#6FA299","9f5fd2f98fb2dd6fd3f7e9d9a5c9ff26482de084"),
	(98,99,99,"En tant que d&#233;veloppeur travaillant sur un projet, je souhaite pouvoir faire avancer l&#145;&#233;tat d&#145;une t&#226;che d&#145;un sprint, afin de mettre &#224; jour son &#233;tat.",3,2,"#6FD899","9f5fd2f98fb2dd6fd3f7e9d9a5c9ff26482de084"),
	(99,99,99,"En tant que PO, je souhaite pouvoir d&#233;finir la priorit&#233; d&#145;une US.",2,1,"#6F28C9","bf0ea57240513941477f03894d55ec02789cc5e9");


REPLACE INTO Task(id_sprint,id_us,description,state) VALUES

	(97,86,"Formulaire de Cr&#233;ation de USER","Done"),
	(97,87,"Formulaire d&#145;authentification de USER","Done"),
	(97,88,"Cr&#233;ation de la page projects.php qui liste tous les projets","Done"),
	(97,91,"Affichage du profil du d&#233;veloppeur","Done"),
	(97,92,"Cr&#233;ation d&#145;un projet","On Going"),
	(97,NULL,"Creation Template","Done"),
	(97,NULL,"Ecriture requ&#234;tes SQL","Done"),
	(97,NULL,"Creation Base de donn&#233;es","Done"),


	(98,89,"Page Historique.php","Done"),
	(98,89,"Page Backlog.php","Done"),
	(98,89,"Page Kanban.php","Done"),
	(98,89,"Affichage d&#145;un projet","Done"),
	(98,89,"Modifier un projet","Done"),
	(98,89,"Affichage du backlog d&#145;un projet","Done"),
	(98,90,"Modification Profil user","Done"),
	(98,NULL,"Requ&#234;tes SQL","Done"),
	(98,NULL,"Modification BD","Done"),
	(98,92,"CreateProject.php","Done"),
	(98,93,"Ajout d&#145;un dev. &#224; un projet","Done"),
	(98,93,"Suppression d&#145;un dev.  d&#145;un projet","Done"),
	(98,93,"AddUser : Tableau au lieu d&#145;une liste avec bouton ajouter et supprimer","Done"),
	(98,94,"settings.php => onglet user story","Done"),
	(98,94,"Ajout d&#145;une US dans un projet","Done"),
	(98,94,"Modifier une US dans un projet","Done"),
	(98,94,"Suppression d&#145;une US d&#145;un projet","Done"),
	(98,95,"Affichage des sprints uniquement","Done"),
	(98,96,"Enlever l&#145;affectation d&#145;un user lors de la cr&#233;ation d&#145;une tache","Done"),
	(98,96,"settings.php => onglet taches","Done"),

	(99,89,"BurnDown Chart","Done"),
	(99,89,"rectification probleme visuel: Historique.php","Done"),
	(99,89,"Changer la couleur de la nav bar","Done"),
	(99,89,"Finalisation KanBan","Done"),
	(99,89,"Modifier backlog pour afficher num&#233;ro de sprint &#224; la place de l&#145;id","Done"),
	(99,89,"Historique afficher num&#233;ro sprint pour une meilleure visibilit&#233;","Done"),
	(99,98,"Drag & Drop Kanban: faire avancer l&#145;etat d&#145;une tache","Done"),
	(99,97,"Drag & Drop Kanban: s&#145;auto-affecter &#224; une tache","Done"),
	(99,99,"Modification de la priorit&#233; seulement par le PO","Done"),
	(99,NULL,"Ajout Champ Couleur US","Done"),
	(99,NULL,"Matrice de tra&#231;abilit&#233;","Done"),
(99,NULL,"Tests de Validation","Done");

	SET FOREIGN_KEY_CHECKS = 1;
