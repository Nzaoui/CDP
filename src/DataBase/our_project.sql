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
<li><a href='https://github.com/Nzaoui/CDP' rel='external'>GitHub de Dev</a></li>
<li><a href='https://github.com/Nzaoui/Cdp_Clean' rel='external'>GitHub Clean</a></li></ul></p>
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
	(97,86,"Atque, ut Tullius ait, ut etiam ferae fame monitae","Done"),
	(97,86,"Pandente itaque viam fatorum sorte tristissima","Done"),
	(97,86,"Denique Antiochensis ordinis vertices sub uno","Done"),
	(97,86,"Cum autem commodis intervallata temporibus","Done"),
	(97,86,"Nemo quaeso miretur, si post exsudatos labores","Done"),
	(97,86,"Denique Antiochensis ordinis temporibus","Done");	


	SET FOREIGN_KEY_CHECKS = 1;