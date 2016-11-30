USE GestionDeProjet;

SET FOREIGN_KEY_CHECKS = 0;

/* Clear all data */
TRUNCATE Task;
TRUNCATE UserStory;
TRUNCATE Sprint;
TRUNCATE WorkOn;
TRUNCATE Project;
TRUNCATE User;

/* Create Users */
INSERT INTO User VALUES
	(1,"Emile","Rey","erey","erey@localhost",SHA2("erey",256)),
	(2,"dev1_first","dev1_last","dev1","dev1@localhost",SHA2("dev1",256)),
	(3,"dev2_first","dev2_last","dev2","dev2@localhost",SHA2("dev2",256)),
	(4,"dev3_first","dev3_last","dev3","dev3@localhost",SHA2("dev3",256));

/* Create Project */
INSERT INTO Project VALUES
	(1,"Un super Projet","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam placerat accumsan ipsum, vitae scelerisque neque fringilla sollicitudin. Curabitur imperdiet lorem quis nibh auctor facilisis. Fusce suscipit arcu bibendum suscipit pulvinar. In at convallis tortor. Duis tincidunt non velit vitae finibus. Nunc viverra arcu in euismod dignissim. Pellentesque commodo vitae metus et facilisis. Ut ornare metus nec arcu mollis, sit amet pharetra ex pellentesque. Vestibulum aliquet vestibulum auctor. Nunc hendrerit urna vel justo maximus suscipit. Nam aliquet arcu quis metus blandit, eget rhoncus quam auctor. Integer rhoncus, ligula eu viverra molestie, massa magna placerat erat, pharetra pulvinar urna velit vel eros.
Phasellus id risus interdum arcu ornare dictum. Nunc vulputate, augue a tristique molestie, tellus ex hendrerit diam, et malesuada urna lacus vel orci. Vivamus rutrum vitae nibh ac cursus. Suspendisse egestas volutpat lectus, id scelerisque urna dignissim vitae. Praesent lobortis sapien semper lectus venenatis dictum. Nam posuere a odio nec varius. Maecenas mi arcu, posuere id auctor nec, lacinia eu nisl. Quisque rhoncus tristique tortor, a eleifend nisi euismod vel. Nunc nec maximus leo, vitae rhoncus purus. Phasellus quis tincidunt nunc. Nam luctus tristique consequat. Vestibulum ac accumsan tortor. Fusce porta sed massa sodales sodales. Maecenas luctus dapibus eros, quis maximus leo blandit et.
Curabitur feugiat, augue sed mollis feugiat, libero nisl bibendum tortor, at consequat massa felis ut mi. In pulvinar ullamcorper fermentum. Quisque dapibus venenatis lorem nec mattis. Praesent vitae sollicitudin nunc, eget condimentum diam. In pharetra faucibus libero, et convallis tellus venenatis sed. Quisque eget quam pulvinar, tempus quam at, ornare justo. Integer commodo maximus urna nec pretium. Morbi eget interdum felis. Phasellus mollis rhoncus pharetra. Ut in condimentum nunc, non dapibus leo. Nullam quis ipsum nunc. Suspendisse in sem ullamcorper, maximus nunc sit amet, lobortis tellus. Proin tempus dignissim libero, at posuere felis hendrerit sit amet. Suspendisse purus risus, sollicitudin non lobortis et, accumsan a sem. Nam rutrum erat ut sapien tincidunt convallis. Nullam volutpat lectus sed erat posuere, ut iaculis sem varius.
Cras non tristique augue. Cras bibendum risus sit amet elit egestas blandit. Aenean eu ex felis. Quisque tellus est, ornare eu rutrum sit amet, interdum egestas neque. In vel mollis enim. Sed imperdiet fermentum dolor eu molestie. Phasellus commodo ligula nec nibh aliquam dapibus. Duis dapibus dolor eu aliquet lobortis. Nulla ornare augue lectus, vel dapibus urna consequat non. Vivamus convallis at mi sed cursus. Mauris vitae ante nec nunc mollis porttitor. Suspendisse potenti. Vestibulum sit amet orci ornare, gravida odio varius, tempus turpis. Cras vitae mi vel dolor sagittis pharetra sed ut felis.
Sed tristique sodales imperdiet. Suspendisse potenti. Nulla facilisi. Donec quis ante bibendum, fringilla libero ac, sollicitudin odio. Mauris luctus feugiat consectetur. In hac habitasse platea dictumst. Phasellus nec nisi sed odio facilisis elementum vel pharetra leo. Phasellus imperdiet, erat vel faucibus cursus, odio felis varius sapien, in condimentum diam velit eget dui.","C",1),
	(2,"Un autre super Projet","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam placerat accumsan ipsum, vitae scelerisque neque fringilla sollicitudin. Curabitur imperdiet lorem quis nibh auctor facilisis. Fusce suscipit arcu bibendum suscipit pulvinar. In at convallis tortor. Duis tincidunt non velit vitae finibus. Nunc viverra arcu in euismod dignissim. Pellentesque commodo vitae metus et facilisis. Ut ornare metus nec arcu mollis, sit amet pharetra ex pellentesque. Vestibulum aliquet vestibulum auctor. Nunc hendrerit urna vel justo maximus suscipit. Nam aliquet arcu quis metus blandit, eget rhoncus quam auctor. Integer rhoncus, ligula eu viverra molestie, massa magna placerat erat, pharetra pulvinar urna velit vel eros.
Phasellus id risus interdum arcu ornare dictum. Nunc vulputate, augue a tristique molestie, tellus ex hendrerit diam, et malesuada urna lacus vel orci. Vivamus rutrum vitae nibh ac cursus. Suspendisse egestas volutpat lectus, id scelerisque urna dignissim vitae. Praesent lobortis sapien semper lectus venenatis dictum. Nam posuere a odio nec varius. Maecenas mi arcu, posuere id auctor nec, lacinia eu nisl. Quisque rhoncus tristique tortor, a eleifend nisi euismod vel. Nunc nec maximus leo, vitae rhoncus purus. Phasellus quis tincidunt nunc. Nam luctus tristique consequat. Vestibulum ac accumsan tortor. Fusce porta sed massa sodales sodales. Maecenas luctus dapibus eros, quis maximus leo blandit et.
Curabitur feugiat, augue sed mollis feugiat, libero nisl bibendum tortor, at consequat massa felis ut mi. In pulvinar ullamcorper fermentum. Quisque dapibus venenatis lorem nec mattis. Praesent vitae sollicitudin nunc, eget condimentum diam. In pharetra faucibus libero, et convallis tellus venenatis sed. Quisque eget quam pulvinar, tempus quam at, ornare justo. Integer commodo maximus urna nec pretium. Morbi eget interdum felis. Phasellus mollis rhoncus pharetra. Ut in condimentum nunc, non dapibus leo. Nullam quis ipsum nunc. Suspendisse in sem ullamcorper, maximus nunc sit amet, lobortis tellus. Proin tempus dignissim libero, at posuere felis hendrerit sit amet. Suspendisse purus risus, sollicitudin non lobortis et, accumsan a sem. Nam rutrum erat ut sapien tincidunt convallis. Nullam volutpat lectus sed erat posuere, ut iaculis sem varius.
Cras non tristique augue. Cras bibendum risus sit amet elit egestas blandit. Aenean eu ex felis. Quisque tellus est, ornare eu rutrum sit amet, interdum egestas neque. In vel mollis enim. Sed imperdiet fermentum dolor eu molestie. Phasellus commodo ligula nec nibh aliquam dapibus. Duis dapibus dolor eu aliquet lobortis. Nulla ornare augue lectus, vel dapibus urna consequat non. Vivamus convallis at mi sed cursus. Mauris vitae ante nec nunc mollis porttitor. Suspendisse potenti. Vestibulum sit amet orci ornare, gravida odio varius, tempus turpis. Cras vitae mi vel dolor sagittis pharetra sed ut felis.
Sed tristique sodales imperdiet. Suspendisse potenti. Nulla facilisi. Donec quis ante bibendum, fringilla libero ac, sollicitudin odio. Mauris luctus feugiat consectetur. In hac habitasse platea dictumst. Phasellus nec nisi sed odio facilisis elementum vel pharetra leo. Phasellus imperdiet, erat vel faucibus cursus, odio felis varius sapien, in condimentum diam velit eget dui.","C#",1),
	(3,"Un Projet bof","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam placerat accumsan ipsum, vitae scelerisque neque fringilla sollicitudin. Curabitur imperdiet lorem quis nibh auctor facilisis. Fusce suscipit arcu bibendum suscipit pulvinar. In at convallis tortor. Duis tincidunt non velit vitae finibus. Nunc viverra arcu in euismod dignissim. Pellentesque commodo vitae metus et facilisis. Ut ornare metus nec arcu mollis, sit amet pharetra ex pellentesque. Vestibulum aliquet vestibulum auctor. Nunc hendrerit urna vel justo maximus suscipit. Nam aliquet arcu quis metus blandit, eget rhoncus quam auctor. Integer rhoncus, ligula eu viverra molestie, massa magna placerat erat, pharetra pulvinar urna velit vel eros.
Phasellus id risus interdum arcu ornare dictum. Nunc vulputate, augue a tristique molestie, tellus ex hendrerit diam, et malesuada urna lacus vel orci. Vivamus rutrum vitae nibh ac cursus. Suspendisse egestas volutpat lectus, id scelerisque urna dignissim vitae. Praesent lobortis sapien semper lectus venenatis dictum. Nam posuere a odio nec varius. Maecenas mi arcu, posuere id auctor nec, lacinia eu nisl. Quisque rhoncus tristique tortor, a eleifend nisi euismod vel. Nunc nec maximus leo, vitae rhoncus purus. Phasellus quis tincidunt nunc. Nam luctus tristique consequat. Vestibulum ac accumsan tortor. Fusce porta sed massa sodales sodales. Maecenas luctus dapibus eros, quis maximus leo blandit et.
Curabitur feugiat, augue sed mollis feugiat, libero nisl bibendum tortor, at consequat massa felis ut mi. In pulvinar ullamcorper fermentum. Quisque dapibus venenatis lorem nec mattis. Praesent vitae sollicitudin nunc, eget condimentum diam. In pharetra faucibus libero, et convallis tellus venenatis sed. Quisque eget quam pulvinar, tempus quam at, ornare justo. Integer commodo maximus urna nec pretium. Morbi eget interdum felis. Phasellus mollis rhoncus pharetra. Ut in condimentum nunc, non dapibus leo. Nullam quis ipsum nunc. Suspendisse in sem ullamcorper, maximus nunc sit amet, lobortis tellus. Proin tempus dignissim libero, at posuere felis hendrerit sit amet. Suspendisse purus risus, sollicitudin non lobortis et, accumsan a sem. Nam rutrum erat ut sapien tincidunt convallis. Nullam volutpat lectus sed erat posuere, ut iaculis sem varius.
Cras non tristique augue. Cras bibendum risus sit amet elit egestas blandit. Aenean eu ex felis. Quisque tellus est, ornare eu rutrum sit amet, interdum egestas neque. In vel mollis enim. Sed imperdiet fermentum dolor eu molestie. Phasellus commodo ligula nec nibh aliquam dapibus. Duis dapibus dolor eu aliquet lobortis. Nulla ornare augue lectus, vel dapibus urna consequat non. Vivamus convallis at mi sed cursus. Mauris vitae ante nec nunc mollis porttitor. Suspendisse potenti. Vestibulum sit amet orci ornare, gravida odio varius, tempus turpis. Cras vitae mi vel dolor sagittis pharetra sed ut felis.
Sed tristique sodales imperdiet. Suspendisse potenti. Nulla facilisi. Donec quis ante bibendum, fringilla libero ac, sollicitudin odio. Mauris luctus feugiat consectetur. In hac habitasse platea dictumst. Phasellus nec nisi sed odio facilisis elementum vel pharetra leo. Phasellus imperdiet, erat vel faucibus cursus, odio felis varius sapien, in condimentum diam velit eget dui.","C++",2),
	(4,"Un super Fantastique","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam placerat accumsan ipsum, vitae scelerisque neque fringilla sollicitudin. Curabitur imperdiet lorem quis nibh auctor facilisis. Fusce suscipit arcu bibendum suscipit pulvinar. In at convallis tortor. Duis tincidunt non velit vitae finibus. Nunc viverra arcu in euismod dignissim. Pellentesque commodo vitae metus et facilisis. Ut ornare metus nec arcu mollis, sit amet pharetra ex pellentesque. Vestibulum aliquet vestibulum auctor. Nunc hendrerit urna vel justo maximus suscipit. Nam aliquet arcu quis metus blandit, eget rhoncus quam auctor. Integer rhoncus, ligula eu viverra molestie, massa magna placerat erat, pharetra pulvinar urna velit vel eros.
Phasellus id risus interdum arcu ornare dictum. Nunc vulputate, augue a tristique molestie, tellus ex hendrerit diam, et malesuada urna lacus vel orci. Vivamus rutrum vitae nibh ac cursus. Suspendisse egestas volutpat lectus, id scelerisque urna dignissim vitae. Praesent lobortis sapien semper lectus venenatis dictum. Nam posuere a odio nec varius. Maecenas mi arcu, posuere id auctor nec, lacinia eu nisl. Quisque rhoncus tristique tortor, a eleifend nisi euismod vel. Nunc nec maximus leo, vitae rhoncus purus. Phasellus quis tincidunt nunc. Nam luctus tristique consequat. Vestibulum ac accumsan tortor. Fusce porta sed massa sodales sodales. Maecenas luctus dapibus eros, quis maximus leo blandit et.
Curabitur feugiat, augue sed mollis feugiat, libero nisl bibendum tortor, at consequat massa felis ut mi. In pulvinar ullamcorper fermentum. Quisque dapibus venenatis lorem nec mattis. Praesent vitae sollicitudin nunc, eget condimentum diam. In pharetra faucibus libero, et convallis tellus venenatis sed. Quisque eget quam pulvinar, tempus quam at, ornare justo. Integer commodo maximus urna nec pretium. Morbi eget interdum felis. Phasellus mollis rhoncus pharetra. Ut in condimentum nunc, non dapibus leo. Nullam quis ipsum nunc. Suspendisse in sem ullamcorper, maximus nunc sit amet, lobortis tellus. Proin tempus dignissim libero, at posuere felis hendrerit sit amet. Suspendisse purus risus, sollicitudin non lobortis et, accumsan a sem. Nam rutrum erat ut sapien tincidunt convallis. Nullam volutpat lectus sed erat posuere, ut iaculis sem varius.
Cras non tristique augue. Cras bibendum risus sit amet elit egestas blandit. Aenean eu ex felis. Quisque tellus est, ornare eu rutrum sit amet, interdum egestas neque. In vel mollis enim. Sed imperdiet fermentum dolor eu molestie. Phasellus commodo ligula nec nibh aliquam dapibus. Duis dapibus dolor eu aliquet lobortis. Nulla ornare augue lectus, vel dapibus urna consequat non. Vivamus convallis at mi sed cursus. Mauris vitae ante nec nunc mollis porttitor. Suspendisse potenti. Vestibulum sit amet orci ornare, gravida odio varius, tempus turpis. Cras vitae mi vel dolor sagittis pharetra sed ut felis.
Sed tristique sodales imperdiet. Suspendisse potenti. Nulla facilisi. Donec quis ante bibendum, fringilla libero ac, sollicitudin odio. Mauris luctus feugiat consectetur. In hac habitasse platea dictumst. Phasellus nec nisi sed odio facilisis elementum vel pharetra leo. Phasellus imperdiet, erat vel faucibus cursus, odio felis varius sapien, in condimentum diam velit eget dui.","HTML/CSS",3);

/* Create Sprint */
INSERT INTO Sprint VALUES 
	(1,1,"2016-11-14","2016-11-18"),
	(2,1,"2016-11-21","2016-11-25"),
	(3,1,"2016-11-28","2016-12-03"),
	(4,2,"2016-11-14","2016-11-18"),
	(5,2,"2016-11-21","2016-11-25"),
	(6,2,"2016-11-28","2016-12-03"),
	(7,2,"2016-12-10","2016-12-30"),
	(8,3,"2016-11-28","2016-12-03"),
	(9,3,"2016-12-10","2016-12-30"),
	(10,4,"2016-12-10","2016-12-30");

/* Create WorkOn */
INSERT INTO WorkOn VALUES
	(2,1),
	(3,1),
	(1,2),
	(4,4);

/* Create UserStory */
INSERT INTO UserStory(id,id_project,id_sprint,description,priority,difficulty,color) VALUES
	(1,1,1,"Preparer un gateau",1,3,"#66CC99"),
	(2,1,2,"Manger le gateau",2,1,"#22CC99"),
	(3,1,2,"Nettoyer",2,1,"#66CA19"),
	(4,2,4,"Lorem ipsum dolor sit amet",2,1,"#6B7C99"),
	(5,2,5,"In bellis e suis et",1,1,"#668599"),
	(6,2,6,"Mercedis sed amore exigamus liberalesque.",1,3,"#6F2C99"),
	(7,4,1,"Vrsicinus sui isdem sed accusatores",2,1,"#66B899");

/* Create Task */
INSERT INTO Task(id_sprint,id_us,description,state) VALUES 
	(1,1,"Atque, ut Tullius ait, ut etiam ferae fame monitae","To-Do"),
	(1,1,"Pandente itaque viam fatorum sorte tristissima","To-Do"),
	(2,2,"Denique Antiochensis ordinis vertices sub uno","On Going"),
	(5,1,"Cum autem commodis intervallata temporibus","To-Do"),
	(6,1,"Nemo quaeso miretur, si post exsudatos labores","Done"),
	(8,2,"Denique Antiochensis ordinis temporibus","Test");


SET FOREIGN_KEY_CHECKS = 1;
