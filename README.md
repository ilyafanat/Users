# Users
Создать бд Users, в ней таблицу user

CREATE TABLE `user` ( <br/>
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,<br/>
  `login` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  `password` varchar(172) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  `email` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  PRIMARY KEY (`id`),<br/>
  KEY `login` (`login`)<br/>
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;<br/>
<br/>
<br/>
CREATE TABLE `time` (<br/>
  `id` int(10) NOT NULL AUTO_INCREMENT,<br/>
  `login_time` datetime DEFAULT '0000-00-00 00:00:00',<br/>
  `id_user` int(10) unsigned NOT NULL DEFAULT '0',<br/>
  `ip` int(11) DEFAULT '0',<br/>
  `logout_time` datetime DEFAULT '0000-00-00 00:00:00',<br/>
  PRIMARY KEY (`id`),<br/>
  KEY `fk_time_1_idx` (`id_user`),<br/>
  CONSTRAINT `fk_time_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE<br/>
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;<br/>
