# Users
Создать бд Users, в ней таблицу user

CREATE TABLE `user` ( <br/>
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,<br/>
  `login` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  `email` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,<br/>
  PRIMARY KEY (`id`),<br/>
  KEY `login` (`login`)<br/>
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;<br/>
<br/>
<br/>
CREATE TABLE `time` (<br/>
  `id` int(10) NOT NULL AUTO_INCREMENT,<br/>
  `logged_at` datetime DEFAULT NULL,<br/>
  `id_user` int(10) unsigned NOT NULL DEFAULT '0',<br/>
  `ip` int(11) DEFAULT '0',<br/>
  `logouted_at` datetime DEFAULT NULL,<br/>
  PRIMARY KEY (`id`),<br/>
  KEY `fk_time_1_idx` (`id_user`),<br/>
  CONSTRAINT `fk_time_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE<br/>
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;<br/>
