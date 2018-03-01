-- <?php exit();?>
-- IJHCMS Multi-Volume Data Dump Vol.2
-- IJHCMS Version:  ZXFZ2.0 20161117
-- MySQL  Version:  5.1.69
-- Create Time   : 2016-12-09 10:25:35
-- Table Prefix  : jh_
-- CopyRight     : http://www.ijh.cc


DROP TABLE IF EXISTS jh_designer_article;
CREATE TABLE `jh_designer_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `content` mediumtext,
  `is_top` tinyint(1) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `uid` (`uid`),
  KEY `__INDEX` (`city_id`,`is_top`,`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

DROP TABLE IF EXISTS jh_designer_attr;
CREATE TABLE `jh_designer_attr` (
  `uid` mediumint(8) unsigned NOT NULL,
  `attr_id` smallint(6) unsigned DEFAULT NULL,
  `attr_value_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_designer_comment;
CREATE TABLE `jh_designer_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `designer_id` mediumint(8) DEFAULT '0',
  `score1` tinyint(3) DEFAULT '0',
  `score2` tinyint(3) DEFAULT '0',
  `score3` tinyint(3) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 AUTO_INCREMENT=33;

DROP TABLE IF EXISTS jh_designer_yuyue;
CREATE TABLE `jh_designer_yuyue` (
  `yuyue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(9) DEFAULT '0',
  `designer_id` mediumint(9) DEFAULT '0',
  `company_id` mediumint(9) DEFAULT '0',
  `mobile` varchar(20) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `dateline` int(11) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`yuyue_id`),
  KEY `designer_id` (`designer_id`),
  KEY `__INDEX` (`uid`,`company_id`,`status`,`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 AUTO_INCREMENT=46;

DROP TABLE IF EXISTS jh_diary;
CREATE TABLE `jh_diary` (
  `diary_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `uid` mediumint(9) DEFAULT '0',
  `company_id` mediumint(9) DEFAULT '0',
  `home_id` mediumint(9) DEFAULT '0',
  `home_name` varchar(100) DEFAULT NULL,
  `thumb` varchar(150) DEFAULT '',
  `type_id` mediumint(9) DEFAULT '0',
  `way_id` mediumint(9) DEFAULT '0',
  `total_price` int(11) DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT '0000-00-00',
  `content_num` smallint(6) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`diary_id`),
  KEY `city_id` (`city_id`,`type_id`,`way_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 AUTO_INCREMENT=33;

INSERT INTO jh_diary VALUES ('1','7','焕然一新～打造美式小三房变身记','146','15','20','北城世纪城','demo/photo/201502/20150215_846B02754BDD737ADF2A7CCFFEAEA1CF.png','12','20','76800','2015-02-01','0000-00-00','4','2','0','3','1','0','127.0.0.1','1423982445');
INSERT INTO jh_diary VALUES ('2','7','流氓和林宝的三口之窝','147','39','15','华润熙云府','demo/photo/201502/20150215_608ABFAB45FA8F41A045BB303095C3BD.png','12','20','74532','2015-01-27','0000-00-00','2','1','0','4','1','0','127.0.0.1','1423982904');
DROP TABLE IF EXISTS jh_diary_comment;
CREATE TABLE `jh_diary_comment` (
  `comment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `diary_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `content` varchar(1024) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '0.0.0.0',
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22;

DROP TABLE IF EXISTS jh_diary_item;
CREATE TABLE `jh_diary_item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `diary_id` mediumint(8) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `content` text,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 AUTO_INCREMENT=53;

INSERT INTO jh_diary_item VALUES ('1','1','1','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">DAY112月15日正式开工了！！拆除旧物及其它</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">1施工内容拆除旧物主要为厨房与卫生间全部拆除，交清理垃圾费1800元</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">2原有物品保护地板采用原有地板，需要用石膏板对原有地板进行保护，因进场时间紧迫，施工单位暂时采用彩条布铺地保护，过一天再采用石膏板进行保护，这也以看看，施工单位是否承诺当初的兑现。</span><br />','127.0.0.1','1423982548');
INSERT INTO jh_diary_item VALUES ('2','1','1','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">DAY212月16日拆除旧物及其它</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">1施工进度预计还需要施工23天左右。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">2施工人员昨天主要是两位工人</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">3施工中出现的协调事宜施工单位承诺的地板石膏板保护，依旧没有送达，已联系管理人员及施工队长，已答应解决这个问题。看明天是否兑现承诺，若不能兑现的话，可以要求停工了。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">4晚上抽空去看看进展如何。</span>','127.0.0.1','1423982567');
INSERT INTO jh_diary_item VALUES ('3','1','1','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">DAY4工地还是拆墙，清理。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">有几点感触</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">1施工进场前的准备工作没有做好，这次太仓促进场了，原房子里的东西应该全部清理干净，如旧家具，旧家电等要全部清楚，给工人进场创造好的施工条件。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">2原想保护地板，前在还要求工人对原地板进行覆盖石膏板进行保护，这点领海的工人做的非常好，前面一讲，后面补救及时，保护的还是不错的，整个施工过程还是比较干净整洁，当天的垃圾当天处理。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">3因为原地板表面非常好，但在拆的过程中发现了重大隐患，因实木地板下面，垫了一层细木工板，木工板下面是龙骨，龙骨之间全用水泥进行包裹处理，原房东做的非常用心，但是年头长了，地板下很多地方都霉了，不拆的话是永远不能发现的。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">4地板回收的功课要早点做，目前上海是有人回收地板的，旧空调都可以回收。原房子里的家具还可以，但是卖不到钱，基本都是白菜价了，5元一个柜子，10元一个台子的。</span>','127.0.0.1','1423982585');
INSERT INTO jh_diary_item VALUES ('4','1','2','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">DAY23水电作业上图</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">1马桶移位，需要提前购好马桶移位器。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">2安排冷热水管进场施工，需要水电工把施工界面留出来。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">3每天晚上到工地与电工交流，还需要什么配合的。</span><br />\r\n<br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">4新问题原房主进户的电信光纤施工过程中断了，这个要提前保护好，联系10000来解决，需要一笔上门安装费用。</span><br />\r\n<br />\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">5电线管的每个隐蔽工程的地方进行拍照，以备后用维修查看使用</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">&nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_FBB3CC4111B949EB620B6942E6935A6D.jpg?PID71\" alt=\"\" />&nbsp; &nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_9082B8B41D7E0A108F5C9F5D15813411.jpg?PID72\" alt=\"\" />&nbsp; &nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_E4DDCE641F942DE83511B0A889C088D7.jpg?PID73\" alt=\"\" />&nbsp; &nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_B67DCEE7407D0B5152BE64B0723972C2.jpg?PID74\" alt=\"\" /><br />\r\n</span>\r\n</p>','127.0.0.1','1423982712');
INSERT INTO jh_diary_item VALUES ('5','2','1','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">南京政府规定，从明年开始，市区不允许燃放鞭炮，所以我们和胡经理商量了一下，于今年的最后一天，也就是12月31日去开工了。看到墙角的苹果没？呵呵呵！南京的风俗，动工讨个吉利，我从家带了6个苹果，每个房间都放了，事事大顺吧！小伙伴们，我迷信了把，鞭炮摆了个吉利数字，嘿嘿！真希望后期装修顺顺利利吧。</span>','127.0.0.1','1423982992');
INSERT INTO jh_diary_item VALUES ('6','2','2','<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">远东的电线和伟星的水管。</span><br />\r\n<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">南京地区安防智能公司用的很多都是这两个，水管还是很厚实的，但不知道具体怎么样？有人能判断出来吗？快递盒里是我自己弄的音响线，想以后给自己家配个家庭影院，呵呵！</span><br />\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\">水电师傅姓吉，父子两人，很少见的姓哦，但人真的还不错，解答我这个外行提的白痴问题，呵呵！虽然讲话不是完全明白，目前还不错。，</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#666666;font-family:\'Microsoft YaHei\', 微软雅黑, \'Microsoft JhengHei\', 华文细黑, STHeiti, MingLiu;font-size:14px;line-height:22px;\"><img src=\"/./attachs/demo/photo/201502/20150215_D55844ACA13D787A9073BC639793CEB3.png?PID76\" alt=\"\" />&nbsp;&nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_927DC0A371CCF71445223665BF80ADE0.png?PID77\" alt=\"\" />&nbsp;&nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_0EFCD3A1225CC6403B56ADC0B3CB8ACF.png?PID78\" alt=\"\" />&nbsp;&nbsp;<img src=\"/./attachs/demo/photo/201502/20150215_629161CF2F37E378044326DA605CEB7C.png?PID79\" alt=\"\" /><br />\r\n</span>\r\n</p>','127.0.0.1','1423983058');
DROP TABLE IF EXISTS jh_fenxiao_log;
CREATE TABLE `jh_fenxiao_log` (
  `log_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT NULL,
  `tenders_id` mediumint(8) DEFAULT NULL,
  `from` tinyint(1) DEFAULT '1',
  `number` decimal(10,2) DEFAULT '0.00',
  `log` mediumtext,
  `admin` varchar(225) DEFAULT NULL,
  `clientip` char(15) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 AUTO_INCREMENT=285;

DROP TABLE IF EXISTS jh_fz_admin;
CREATE TABLE `jh_fz_admin` (
  `fz_uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fz_name` varchar(30) DEFAULT '',
  `fz_passwd` char(32) DEFAULT '',
  `city_id` smallint(6) DEFAULT '0',
  `role` enum('admin','editor') DEFAULT NULL,
  `priv` mediumtext,
  `contact` varchar(20) DEFAULT '',
  `mail` varchar(50) DEFAULT '',
  `phone` varchar(15) DEFAULT '',
  `lastlogin` int(10) DEFAULT '0',
  `lastip` char(15) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`fz_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16;

DROP TABLE IF EXISTS jh_gz;
CREATE TABLE `jh_gz` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `group_id` smallint(6) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `qq` varchar(15) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `case_num` smallint(6) DEFAULT '0',
  `attention_num` smallint(6) DEFAULT NULL,
  `site_num` smallint(6) DEFAULT '0',
  `yuyue_num` smallint(6) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `score` mediumint(8) DEFAULT '0',
  `score1` mediumint(8) DEFAULT '0',
  `score2` mediumint(8) DEFAULT '0',
  `score3` mediumint(8) DEFAULT '0',
  `slogan` varchar(150) DEFAULT '',
  `about` mediumtext,
  `tenders_num` mediumint(8) DEFAULT '0',
  `tenders_sign` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `flushtime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `orderby` (`yuyue_num`,`views`,`score`,`orderby`,`flushtime`),
  KEY `__INDEX` (`city_id`,`area_id`,`audit`,`closed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_gz VALUES ('117','6','7','8','蒋工长','504354984','13654876552','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是蒋工长，籍贯安徽，本人拥有19年装修经验，现有工人42人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1417419147');
INSERT INTO jh_gz VALUES ('118','6','7','4','钱工长','832540148','13437984560','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是钱工长，籍贯安徽，本人拥有10年装修经验，现有工人35人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1417481071');
INSERT INTO jh_gz VALUES ('119','6','7','11','戴工长','910025854','13713488222','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是戴工长，籍贯安徽，本人拥有7年装修经验，现有工人45人，可同时承接15个家装工程','0','0','50','1423974228','1','0','1417527923');
INSERT INTO jh_gz VALUES ('120','6','7','10','蒋工长','1141959732','13951696710','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是蒋工长，籍贯安徽，本人拥有14年装修经验，现有工人34人，可同时承接14个家装工程','0','0','50','1423974228','1','0','1417571595');
INSERT INTO jh_gz VALUES ('121','6','7','6','孙工长','152373680','13044238261','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是孙工长，籍贯安徽，本人拥有5年装修经验，现有工人30人，可同时承接14个家装工程','0','0','50','1423974228','1','0','1417620196');
INSERT INTO jh_gz VALUES ('122','6','7','14','鲁工长','539227793','13567189434','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有16年装修经验，现有工人32人，可同时承接14个家装工程','0','0','50','1423974228','1','0','1417680916');
INSERT INTO jh_gz VALUES ('123','6','7','4','鲁工长','953081747','13978666678','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有14年装修经验，现有工人38人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1417732138');
INSERT INTO jh_gz VALUES ('124','6','7','8','杨工长','1059263114','13890070367','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是杨工长，籍贯安徽，本人拥有17年装修经验，现有工人31人，可同时承接10个家装工程','0','0','50','1423974228','1','0','1417786647');
INSERT INTO jh_gz VALUES ('125','6','7','10','单工长','277220585','13698753367','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是单工长，籍贯安徽，本人拥有6年装修经验，现有工人34人，可同时承接15个家装工程','0','0','50','1423974228','1','0','1417855459');
INSERT INTO jh_gz VALUES ('126','6','7','8','施工长','146305489','13743890927','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是施工长，籍贯安徽，本人拥有17年装修经验，现有工人17人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1417920273');
INSERT INTO jh_gz VALUES ('127','6','7','11','赵工长','165453120','13137718060','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是赵工长，籍贯安徽，本人拥有7年装修经验，现有工人15人，可同时承接10个家装工程','0','0','50','1423974228','1','0','1417978371');
INSERT INTO jh_gz VALUES ('128','6','7','7','赵工长','1161305304','13394350604','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是赵工长，籍贯安徽，本人拥有16年装修经验，现有工人24人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418020076');
INSERT INTO jh_gz VALUES ('129','6','7','6','赵工长','1091236462','13069198758','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是赵工长，籍贯安徽，本人拥有16年装修经验，现有工人16人，可同时承接13个家装工程','0','0','50','1423974228','1','0','1418075017');
INSERT INTO jh_gz VALUES ('130','6','7','11','鲁工长','866529782','13220536588','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有16年装修经验，现有工人16人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418114292');
INSERT INTO jh_gz VALUES ('131','6','7','10','孙工长','553383604','13772824082','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是孙工长，籍贯安徽，本人拥有5年装修经验，现有工人27人，可同时承接14个家装工程','0','0','50','1423974228','1','0','1418159300');
INSERT INTO jh_gz VALUES ('132','6','7','4','何工长','371359944','13155080333','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是何工长，籍贯安徽，本人拥有16年装修经验，现有工人38人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1418218712');
INSERT INTO jh_gz VALUES ('133','6','7','3','鲁工长','109015670','13779292203','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有6年装修经验，现有工人32人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418275065');
INSERT INTO jh_gz VALUES ('134','6','7','7','何工长','310925109','13662082979','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是何工长，籍贯安徽，本人拥有10年装修经验，现有工人40人，可同时承接13个家装工程','0','0','50','1423974228','1','0','1418338202');
INSERT INTO jh_gz VALUES ('135','6','7','10','孙工长','1162282127','13429833444','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是孙工长，籍贯安徽，本人拥有11年装修经验，现有工人27人，可同时承接13个家装工程','0','0','50','1423974228','1','0','1418385030');
INSERT INTO jh_gz VALUES ('136','6','7','13','施工长','38488498','13222151956','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是施工长，籍贯安徽，本人拥有11年装修经验，现有工人17人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1418456116');
INSERT INTO jh_gz VALUES ('137','6','7','3','单工长','458235623','13171198747','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是单工长，籍贯安徽，本人拥有8年装修经验，现有工人31人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418511711');
INSERT INTO jh_gz VALUES ('138','6','7','6','周工长','951084413','13193284181','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是周工长，籍贯安徽，本人拥有11年装修经验，现有工人46人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1418554438');
INSERT INTO jh_gz VALUES ('139','6','7','5','郑工长','687998163','13083130029','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是郑工长，籍贯安徽，本人拥有20年装修经验，现有工人31人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418617433');
INSERT INTO jh_gz VALUES ('140','6','7','6','鲁工长','794268122','13063145396','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有13年装修经验，现有工人46人，可同时承接10个家装工程','0','0','50','1423974228','1','0','1418671251');
INSERT INTO jh_gz VALUES ('141','6','7','10','郭工长','459908899','13649643632','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是郭工长，籍贯安徽，本人拥有10年装修经验，现有工人31人，可同时承接15个家装工程','0','0','50','1423974228','1','0','1418710840');
INSERT INTO jh_gz VALUES ('142','6','7','13','何工长','537661570','13597711858','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是何工长，籍贯安徽，本人拥有8年装修经验，现有工人34人，可同时承接15个家装工程','0','0','50','1423974228','1','0','1418759728');
INSERT INTO jh_gz VALUES ('143','6','7','5','戴工长','867301553','13836082610','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是戴工长，籍贯安徽，本人拥有18年装修经验，现有工人36人，可同时承接14个家装工程','0','0','50','1423974228','1','0','1418808557');
INSERT INTO jh_gz VALUES ('144','6','7','7','鲁工长','198163269','13143757706','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是鲁工长，籍贯安徽，本人拥有9年装修经验，现有工人21人，可同时承接11个家装工程','0','0','50','1423974228','1','0','1418860072');
INSERT INTO jh_gz VALUES ('145','6','7','7','钱工长','577955044','13217083069','0','','0','0','0','0','0','0','0','0','以质量树口碑 以诚信谋发展 让您对装修更放心','各位业主大家好，我是钱工长，籍贯安徽，本人拥有18年装修经验，现有工人29人，可同时承接12个家装工程','0','0','50','1423974228','1','0','1418921888');
DROP TABLE IF EXISTS jh_gz_attr;
CREATE TABLE `jh_gz_attr` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `attr_id` smallint(6) DEFAULT '0',
  `attr_value_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_gz_attr_copy;
CREATE TABLE `jh_gz_attr_copy` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `attr_id` smallint(6) DEFAULT '0',
  `attr_value_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_gz_comment;
CREATE TABLE `jh_gz_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `gz_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `score1` tinyint(3) DEFAULT '0',
  `score2` tinyint(3) DEFAULT '0',
  `score3` tinyint(3) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;

DROP TABLE IF EXISTS jh_gz_copy;
CREATE TABLE `jh_gz_copy` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `group_id` smallint(6) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `qq` varchar(15) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `case_num` smallint(6) DEFAULT '0',
  `attention_num` smallint(6) DEFAULT NULL,
  `site_num` smallint(6) DEFAULT '0',
  `yuyue_num` smallint(6) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `score` mediumint(8) DEFAULT '0',
  `score1` mediumint(8) DEFAULT '0',
  `score2` mediumint(8) DEFAULT '0',
  `score3` mediumint(8) DEFAULT '0',
  `slogan` varchar(150) DEFAULT '',
  `about` mediumtext,
  `tenders_num` mediumint(8) DEFAULT '0',
  `tenders_sign` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `flushtime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `orderby` (`yuyue_num`,`views`,`score`,`orderby`,`flushtime`),
  KEY `__INDEX` (`city_id`,`area_id`,`audit`,`closed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_gz_yuyue;
CREATE TABLE `jh_gz_yuyue` (
  `yuyue_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `gz_id` mediumint(8) DEFAULT '0',
  `mobile` varchar(20) DEFAULT '',
  `contact` varchar(30) DEFAULT '',
  `content` varchar(1024) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`yuyue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29;

DROP TABLE IF EXISTS jh_home;
CREATE TABLE `jh_home` (
  `home_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `title` varchar(150) DEFAULT '',
  `name` varchar(30) DEFAULT '',
  `thumb` varchar(150) DEFAULT '',
  `phone` varchar(30) DEFAULT '',
  `kfs` varchar(150) DEFAULT '',
  `qq_qun` varchar(15) DEFAULT '',
  `price` varchar(15) DEFAULT '',
  `kp_date` date DEFAULT NULL,
  `jf_date` date DEFAULT NULL,
  `lng` varchar(15) DEFAULT '',
  `lat` varchar(15) DEFAULT '',
  `addr` varchar(150) DEFAULT '',
  `views` mediumint(8) DEFAULT '0',
  `photos` mediumint(8) DEFAULT '0',
  `case_num` mediumint(8) DEFAULT '0',
  `site_num` mediumint(8) DEFAULT '0',
  `content` mediumtext,
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` char(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`home_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 AUTO_INCREMENT=63;

INSERT INTO jh_home VALUES ('1','7','8','','禹洲天玺','demo/photo/201502/20150214_0607A4D87A9A8D1D6B70239C3E824B17.jpg','','合肥舜洲置业有限公司','','','','0000-00-00','','','肥西桃花镇繁华大道以南、泰山路以西 ','0','0','0','0','禹洲天玺项目位于安徽省合肥市肥西县，北至繁华大道，西至祝融路，冬至泰山路，南至长古路。总用地面积156750㎡，总建筑面积604231㎡，其中住宅建筑面积424585㎡，外加47000㎡商业以及相应配套用房。项目容积率3.0，建筑密度22%，绿地率大于40%。住宅户型60-123㎡不等，洋房户型112-126㎡。高层为经典ART-DECO风格，洋房为英伦风格，代表着中产的、富足的、雅致的、美好的生活状态。 禹洲天玺1#楼工程规划许可证编号34012320140150.','50','1','0','','0');
INSERT INTO jh_home VALUES ('2','7','7','','禹洲翡翠湖郡','demo/photo/201502/20150214_70073564E4953C10B2E3F94CC559C56D.jpg','','禹洲地产','','7300','','0000-00-00','','','经开区翡翠路与紫云路交叉口（翡翠湖公园正门对面） ','0','0','0','0','禹洲地产成立于1994年，总部位于厦门。砥砺耕耘近20余载，禹洲人秉承着\"大禹治水，荒漠成洲\"的先贤精神，将禹洲打造成为集房地产开发建设、商业投资和运营管理、物业管理为一体的多元化、集团化的大型综合性跨国企业，连续八年蝉联中国房地产百强企业。禹洲地产，在安徽合肥继禹洲天境之后的第2个作品，将打造成为无愧于天然翡翠湖的精品高尚住区。禹洲地产自进驻合肥以来，凭借强大的品牌实力、精准的市场定位、优秀的产品规划、超大规模的体量受到了合肥市民的热烈追捧，同时也得到与会专家的高度评价，先后获得了“最佳景观楼盘”、“最具投资潜力楼盘”、“最佳性价比楼盘”、“最佳户型楼盘”、“最佳楼盘典范”等众多荣誉，业已成为合肥市民的首选人居品牌。 禹洲·翡翠湖郡，南临紫云路，北接环境优美的翡翠湖。项目周边原生态景观一览无遗，大学城、迎宾馆优雅的人文涵养，将打造成翡翠湖畔的国宾级生态筑区。禹洲翡翠湖郡项目采用ARTDECO建筑风格，高耸、挺拔的建筑,给人以拔地而起、傲然屹立的非凡气势。外立面采用暖色和金属色，碰撞中迸发出和谐之美。在园林景观设计上，小区内设景观节点精工酝酿，景观依据地块边沿呈环绕之势。通过借景的方式引入自然风光，形成一个主景观区域、四个景观节点以及一条中央景观大道，相互辉映，形成完整的空间布局。加上翡翠湖涤荡浓郁情怀，内外双景合璧，整个社区彰显出“生态园林、望湖而居”的大雅格局。','50','1','0','','0');
INSERT INTO jh_home VALUES ('3','7','9','','万科森林公园','demo/photo/201502/20150214_18465530AEB0328EDF6611202F0EAAB9.jpg','','合肥万科置业有限公司,合肥万科瑞翔地产有限公司','','9400','','0000-00-00','','','庐阳区北二环与四里河路交口西南角 ','0','0','0','1','万科森林公园三宗连体地块，包括N1210号、N1211、N1212地块，2012年9月6日被万科竞得。三地块共占地775亩。万科四里河地块详细信息为：庐阳N1210号宗地座落于庐阳区北二环与四里河路交口，四至范围：东至紫衫路、南至固镇路、西至绿杨路、北至北二环路，出让面积达264.4亩，规划用于居住用地，出让70年，容积率1.0＜R≤2.75，绿地率≥40%，建筑密度≤24%，参考地价280万/亩（不含契税、印花税），竞买保证金3亿元。庐阳N1211号宗地座落于庐阳区北二环与四里河路交口，四至范围：东至四里河、南至紫荆街、西至紫衫路、北至北二环路，出让面积达298亩，规划用于商业金融业用地（出让40年）和居住用地（出让70年），容积率1.0＜R≤2.8，绿地率≥40%，建筑密度≤22%，参考地价320万/亩（不含契税、印花税），竞买保证金3亿元。庐阳N1212号宗地座落于庐阳区北二环与四里河路交口，四至范围：东至紫衫路、南至森景湖路、西至 绿杨路、北至固镇路，出让面积达212.94亩，规划用于居住用地，出让70年，容积率1.0＜R≤2.5，绿地率≥45%，建筑密度≤22%，参考地价320万/亩（不含契税、印花 税），竞买保证金3亿元。','50','1','0','','0');
INSERT INTO jh_home VALUES ('4','7','11','','禹洲中央广场','demo/photo/201502/20150214_40D1D53B791141FEC1C794784795E2E3.jpg','','禹洲置业（合肥）东城有限公司[相关网站]','','6100','','0000-00-00','','','肥东长江东路与燎原路交汇处 ','0','0','0','0','禹洲中央广场，中国房地产36强上市名企禹洲集团深耕合肥的又一力作。禹洲中央广场项目位于安徽省合肥市肥东县，北至长江东路（合店路），西至燎原路，东至南环路，总建面达120万方，致力于打造集五星酒店、5A级写字楼、墅级洋房、高层住宅、精品公寓等为一体的大型城市综合体。项目毗邻临龙泉路主干道，龙塘高速路段、肥东高速路段、城市轨道交通二号线、公交线路直达小区，公交立体交通四通八达。禹洲中央广场项目用地面积为279534平方米，其中商业用地80000平方米，住宅用地面积199534平方米。绿地率≥45%，力求实现各个组团均享有大中庭景观的空间效果，通过高层住宅的围合，形成各自独立的中央庭院，且以景观轴线联系起来。营造尺度宜人的景观空间。80-130㎡奢景高层，主流户型，满足大部分人群需求，独特的ARTDECO建筑风格、全业态的完美组合、大型皇家园林景观、奢景高层和洋房，挚揽中心领地。小区拥有自建幼儿园，让孩子赢在起跑线。禹洲中央广场项目沿南环路设置商业内街，源自国际化精心考量的百货、时装、精品店、国际美食、大型酒楼、咖啡茶座、数码影像、室内娱乐、美容休闲等与shopping mall南侧的金街相联系，形成舒适、连续的逛街流线，一站式购物生活轻松实现。禹洲中央广场项目距被称为“合肥市大菜篮”的徽商城农产品批发市场仅1.5公里，大型购物中心、医疗、银行、乡镇机关等相关配套环伺左右，身处其中，畅享缤纷万象生活。禹洲地产在精研高端人居生活20年后，于中央广场掌一城中央至尊，成就禹州地产”以诚建城，以爱筑家“的品牌主张。质变东城，我是中心，项目即将盛世开启，敬请期待！','50','1','0','','0');
INSERT INTO jh_home VALUES ('5','7','5','','合肥万达文化旅游城','demo/photo/201502/20150214_BBD5DD4CF217581886FDEDF30ADCBF87.jpg','','万达投资集团','','','','0000-00-00','','','滨湖新区庐州大道与环湖北路交口 ','0','0','0','0','合肥万达文化旅游城是万达集团凭借多年在商业、文化、旅游产业积累的丰富经验，创新的世界首个特大型文化旅游商业综合项目，具有项目创意世界唯一、设计团队大师组合、万达拥有知识产权三大特点。合肥万达文化旅游城规划有文化、旅游、商业、酒店、滨湖酒吧街五大内容，室内室外结合，以室内为主，彻底解决气候对游乐的影响。　 合肥万达文化旅游城是华东最大的文化旅游投资项目、华东最大的互动电影乐园、 最大星级酒店群、华东最大国际电影城、华东唯一室外文化体验区、华东唯一大型舞台秀剧场、华东唯一的室内恒温水世界、华东最前沿的湖岸酒吧街、华东最顶尖的品牌商业中心。　　项目建成后日最大接待量10万人次，可同时容纳5万名游客，预计年接待游客2000万人次。直接创造3万个就业岗位，文化旅游综合年收入50亿元。','50','1','0','','0');
INSERT INTO jh_home VALUES ('6','7','9','','高速中央广场','demo/photo/201502/20150214_9EDDD0EEA019AB6CAE910780674EC237.jpg','','安徽高速公路房地产有限责任公司[相关网站]','','8400','','0000-00-00','','','滨湖新区包河大道与紫云路交叉口西北 ','0','0','0','0','一座城市、一个区域少不了建筑的精神符号，正如纽约有自由女神像，巴黎有埃菲尔铁塔，伦敦有大本钟，而安徽的精神符号暂时缺失。随着滨湖建设的步伐日益加大，一个声音呼之欲出，要为安徽建立精神符号，为合肥建造城市样板。国企高速第二次献礼滨湖区，在滨湖时代广场之后，继续发扬中国时代精神，于核心区省级行政办公区再立一座时代城。聆听时代的声音，把握时代的中心，高速地产始终位列时代先锋，以超凡的远见致力于安徽的建设，立下赫赫战功。 高端住宅、ShoppingMall、品牌商业、甲级写字楼四大业态是高速时代城为现代滨湖人居提供的基础配备；联袂百大集团实现两大国企强强联合，则为高端人居提供了更为高端的选择。在未来，时代城综合业态将会为生活提供面面俱到的服务，创造前所未见的乐活画面。不久的将来，大批综合体轮番上市，时代城的模仿者也会层出不穷。但是，时代城首发的地位无可动摇，时代城创新开拓的精神无法抄袭，70万方超大体量的时代大城无可撼动。以品质书写卓越，以创新塑造传奇，这就是高速·时代城传达的时代理念。高速时代城，高速地产集团携手合肥百大集团联合打造的品质标杆项目。项目总占地面积约232亩，总建筑面积约70万㎡，定位为聚合高端商业办公、高档住宅于一体的大型城市综合体。项目位于包河大道与紫云路交口西北角，是主城区出入滨湖新区的门户要地，地理位置十分优越。包河大道、紫云路两条快速道路极大提升社区出行效率，规划中的地铁7号线途经项目，与其他地铁线路衔接成网，无缝融入合肥主城区。项目所属片区规划为省级行政办公核心区，各类配套将快速发展，即将形成高档商务、高端商业、高层次住区的副中心。同时，塘西河、方兴湖等带片状水景，构筑了丰富的生态环境资源，使得片区成为滨湖高档生态住区。　　为达成标杆级的商业地标，高速地产集团携手百大集团将合力打造百大在安徽最大的SHOPPING MALL，近8万平方米的恢弘体量将引入众多一线品牌，倾力打造一个集购物、餐饮、娱乐、休闲等众多形态为一体的一站式商业航母。　　怀揣品质人居的理念与梦想，集成多年开发建设的经验，高速滨湖时代城旨在树立高速地产集团新的品质标杆，成为诠释高速地产集团“精品筑家 臻于至善”企业发展理念的典范之作！','50','1','0','','0');
INSERT INTO jh_home VALUES ('7','7','6','','滨湖万科城','demo/photo/201502/20150214_BAAEF1A6F3B7C94839D57CE7CD0CCA31.jpg','','合肥万科皓智地产有限公司','','9000','','0000-00-00','','','滨湖新区徽州大道与云谷路交汇处西行约900米 ','0','0','0','0','滨湖万科城是由万科开发建设，合肥万科继金色名郡、金域华府之后倾力打造的第三个装修房高端住宅项目。滨湖万科城，位于合肥市滨湖新区城市主干道云谷路与四川路交汇处，为国际金融后台服务基地核心地段，总建筑面积约46万平方米，绿化率约40%，4000余户家庭在此共同成长。滨湖万科城，以绿色现代生活为规划理念，糅合泰式园林热情、神秘，浪漫的异域风情，提升滨湖绿色一星建筑标准，融合区域与城市发展，创造多元、开放的生态居住区，贡献新一代城市居住中心。','50','1','0','','0');
INSERT INTO jh_home VALUES ('8','7','11','','万科蓝山','demo/photo/201502/20150214_094AEF874294C312F6C47EB230518691.jpg','','合肥万科新城地产有限公司','','9700','','0000-00-00','','','滨湖新区庐州大道与紫云路交口 ','0','0','0','1','万科蓝山项目位于合肥市滨湖新区城市主干道庐州大道与紫云路交汇处，为滨湖新区核心居住区，完善的配套，优良的教育资源、医疗环境为优居生活提供强力保障。项目为集退台电梯花园洋房、高层住宅、风情商业街等物业形态于一体的环湖优质生活区，10万平方米自带集中商业，万科创新的“3+1”户型产品以及退台电梯花园洋房，将创领合肥人居新标杆。同时，地块内包括合肥市建设中的轨道交通1号线紫云路站点，未来居住出行将与现代城市生活更为紧密。2012，万科蓝山携手滨湖万科城，提升优居生活品质，开启滨湖新都心。 蓝山作为万科成熟的系列产品之一，已先后在北京、沈阳、青岛、上海、广州、镇江、长春等地相继推出。2012，第八座蓝山行至合肥，而此次蓝山的到来也正式开启了万科全系产品布局合肥的新篇章。寻找一种生活，在跌宕多姿的人生旅途中攀越高峰，蓦然回首间，感动心灵。万科蓝山，臻献60万方新城市生活蓝本，采用开放式街区规划，用生动的建筑表情，放缓都市紧绷的节奏。沿承万科经典，情景电梯花园洋房，臻献层层退台，空中庭院精彩非凡。万科新一代高层住宅产品孕育而生，创所未见，高利用率约92平米3+1房，从容鉴赏第四房。名校环伺：滨湖寿春中学R26;第四十六中学R26;第四十八中学R26;合肥一中R26;师范附小R26;屯溪路小学（滨湖校区）完善医疗：滨湖医院——特大型三级综合性医院标准，国际一流大型诊断、治疗和科研设备生态新区：巢湖湿地公园R26;塘西河公园R26;金斗公园R26;沿街高绿化购物配套：世纪金源购物中心R26;万尚百货R26;居然之家R26;永辉超市R26;万国农贸休闲配套：世纪金源大饭店R26;华谊兄弟影城R26;滨湖国际会展中心便利交通：“三纵四横”道路可快速到达合肥各区，BRT快速公交（已运营）R26;轨道交通1号线（建设中）紫云路站点','50','1','0','','0');
INSERT INTO jh_home VALUES ('9','7','6','','万科金域华府','demo/photo/201502/20150214_7B7DF2FC9CFF5A45B6B80D2E3D662D65.jpg','','合肥一航万科地产有限公司[相关网站]','','11500','','0000-00-00','','','蜀山区长江西路与合作化南路交叉口西南侧 ','0','0','0','0','万科金域华府为万科在合肥倾力打造的48万平米市心顶级项目，位于合肥市蜀山区长江西路与合作化南路交叉口西南侧（五里墩江淮仪表厂），占地面积173.5亩，综合容积率3．56，小区居住用地占地面积101754平，主题商业开发占地面积13875平，社区规划有双会馆。万科金域华府大事记：2008年5月份，万科取得以挂牌方式出让的江淮地块，成交单价为174.71万元/亩。2010年4月21日，合肥市规划局网站对江淮地块项目规划建筑设计方案进行了公示。 鸟瞰规划图显示规划有17栋高层住宅和3栋高层公寓。 2010年6月，万科江淮地块命名为万科金域华府。','50','1','0','','0');
INSERT INTO jh_home VALUES ('10','7','5','','淮矿东方蓝海','demo/photo/201502/20150214_06E7F83B03C7519F246BA9C769912E7B.jpg','','淮矿地产安徽东方蓝海有限公司','','7800','','0000-00-00','','','滨湖新区徽州大道与云谷路交汇处向东500米 ','0','0','0','0','淮矿东方蓝海占地约524亩，规划建筑总面积约115万平方米。淮矿东方蓝海建筑设计为简欧风格，由54栋22-33层高层和22栋独栋商业组成，配有两个高档会所，是滨湖新区目前惟一全部采取精装修的高档楼盘。项目交通便捷，周围规划有2条轨道交通，地理位置优越，毗邻合肥国际金融后台服务基地。','50','1','0','','0');
INSERT INTO jh_home VALUES ('11','7','3','','禹洲天境','demo/photo/201502/20150214_15F0C37CD2FBE96C4D20DE9939C1A96D.jpg','','合肥禹洲房地产开发有限公司','','6900','','0000-00-00','','','经开区松林路与石笋路交口 ','0','0','0','0','禹洲天境总建筑面积超过120万平米，雄踞合肥市西南片区政务区南，位于松林路和石笋路交汇处，与政务区一河之隔，形成无缝对接，完全享有合肥乃至安徽最高端、最先进、最完善的居住购物、休闲娱乐、行政办公等相关配套。续2011年热卖12亿走势，2012年上半年再次上演逆势火爆劲销，销售量位居合肥三甲！ 究其热卖的原因，项目位置得天独厚，周边配套成熟丰富。社区自身配备12班中科院幼儿园，同时还配备了42班九年义务公办学校，提升投资环境，发挥高校优质教育资源的辐射带动作用，进一步解决学区居民子女“上好学”问题，润安公学，大学城近在咫尺，形成一站式菁英教育，让下一代赢在起跑线上。项目毗邻市政府、市委、省博物馆文博院，安享天鹅湖、翡翠湖、南艳湖等绿色资源，体验沃尔玛、万达广场、万象城、天鹅湖大酒店、国际会展中心、徽园、极地海洋世界、欢乐岛等丰盛生活配套。禹洲天镜一期、二期自09年入市以来，大盘价值即备受合肥购房者期待，项目自首次预约认筹开始就迅速火爆，实现开盘必售磬，加推必热销的场景。现在一期、二期房源基本售磬，一期23栋多层、4栋高层，二期16栋多层业已交房，二期17栋高层交房在即，二千余位业主已经率先享受到超级大盘的幸福生活。三期阳光花城8月即将载誉而出，12栋18-33层高层美宅静享醇熟之美！三期阳光花城规划统一、风格突出，以Art Deco结合简欧风格，应用温馨隽永的深黄色调，采用深色抛光花岗岩石面材配套共建材料，与一、二期住宅主楼风格色系一致。以人车分流、底层局部架空彰显“以人为本”的设计理念，采用大型中央园林景观和多重景观庭园互相辉映的格局，实现景观共享、生态环境、自然形态和谐共生的社区形态，充分显露禹洲天镜的大盘优势。三期内部景观依然遵循“大视野、大景观、大生态”的国际景观规划理念，尊重原有基地景观、保护原有基地景观资源、考量社区人行、车行诉求实施层层递进的景观网络。运用都市自然主义手法，将建筑本身艺术元素和恢弘深蕴的园林景观相切合，漫步于社区形成“移步易景，步步亦景”的花园式景观效应。让业主进入社区就可享受闲逸、安宁的生活气氛。阳光花城整体醇熟之美已徐徐展开，高性价比户型设计更让您静享生活真味。禹洲天境（三期）阳光花城为18-33层高层、68—100㎡高性价比两房、三房产品。户型设计板式建筑、方正、紧凑、合理、户户赠送飘窗，部分户型赠送大露台、空中花园。8月下旬即将闪亮登场，现正在接受预约认筹，认筹前100名享2000元额外优惠。禹洲天境是一座绿色王国，层层叠出叶片，葱翠欲滴，烂漫摇曳，散溢着淡淡的幽香，惹得蜂蝶飞舞，路过此旁的行人无不驻足停留观望，形成禹洲天境一道独特的景观。禹洲地产旗下华侨城物业，让居住在社区里的居民享受到统一的物业管理和服务，配备统一的保安巡逻、卫生清洁、车辆管理、绿化养护和完善的家政服务等，小区设置安防系统，包括周界防攀越系统、电子保安巡更系统、楼宇访问对讲系统、住宅联网报警系统、消防报警系统及闭路监控系统，在保障安全的同时使居住不受外部嘈杂环境影响，得以安居乐业。 三期阳光花城占地131951㎡，总建筑面积36500㎡，其中地上建筑面积356270㎡，容积率仅为2.7，绿化率高达45%，共规划3942户。','50','1','0','','0');
INSERT INTO jh_home VALUES ('12','7','6','','淮矿馥邦天下','demo/photo/201502/20150214_1E608281D95675E4F71648C6B48A0C62.jpg','','淮南矿业集团','','8000','','0000-00-00','','','高新区科学大道西、海棠路南 ','0','0','0','0','淮矿馥邦天下由淮南矿业集团打造，位于科学大道西、海棠路南。由8栋多层洋房、3栋小高层洋房、16栋高层住宅（含公寓）、1栋会所、1栋幼儿园、1所24班代建学校以及商业组成。规划建设成为一个交通便捷、环境优美、设施齐备、生活诗意的高档住宅社区。','50','1','0','','0');
INSERT INTO jh_home VALUES ('13','7','11','','佳源巴黎都市','demo/photo/201502/20150214_979ADBFA963D8089E66F6DD3917F7F3E.jpg','','浙江佳源房地产开发有限公司[相关网站]','','8400','','0000-00-00','','','滨湖新区庐州大道与中山路交叉口 ','0','0','0','0','佳源巴黎都市是由浙江佳源集团开发的滨湖区新项目，项目东起庐州大道，北接万科蓝山，南至中山路，四地块拼接成规则四边形，占地面积有625.32亩，其中三大居住地块单价600万/亩以上，楼面价3000多元/平方米。项目为欧式建筑风格，将为合肥市民带来欧式浪漫风情享受。梦想之上——170万方法式风情大盘  实现浪漫巴黎梦想人人心里都有一个巴黎梦，这里的生活美丽又浪漫。佳源巴黎都市整体设计采用法式建筑风格，规划了“一心、二街、两轴、五片区、六广场”。主入口以气势恢宏的“凯旋门”作为标志性门头，象征着业主们每天凯旋而归。宽52米的香榭丽舍大道、20000平方米的凯旋广场、卢浮宫婚庆礼堂，设置柱廊、水池、水景、喷泉、雕塑等小品元素，配以错落有致的绿植、四季更迭的花海、温馨灵动的灯光，营造出舒适随意的园林空间感，打造成滨湖区的婚纱摄影基地，让你回家就如在梦幻巴黎度假一般的心旷神怡。公园之上——750亩塘西河公园  美景生活相伴一生巴黎都市南面紧邻合肥省政府重点打造的主题公园——塘西河生态湿地公园，公园总占地近550万平米，集健身休闲、度假旅游、文化娱乐等功能于一体。业主在家中即可一览公园水色花丛的美景，同时公园的绿植与水系将清新空气与风生水起之势引入到室内，为业主提供一个健康福气的最佳居所，诠释出一个浪漫公园居住梦想。地铁之上——滨湖新区核心地段  交通枢纽地铁入口佳源巴黎都市位于合肥市滨湖新区的核心地段，毗邻塘西河湿地生态公园及省政府政务中心、拥有丰富的优质学区资源、25万方的商业配套，同时巴黎都市沿中山路和庐州大道交叉口广场将作为1号地铁线在滨湖区的的首个入口广场，是滨湖区的重要交通枢纽站，业主乘地铁到市中心仅需15分钟 ，交通便捷，地段升值潜力无限。名校之上——一站式教育基地 让您的孩子赢在起跑线上滨湖区为省政府重点打造的未来城市中心，引入大量的优质学区资源，目前已有的学校有寿春中学、师范附小、46中等，未来还将引入更多的优质学区，巴黎都市社区还规划了高品质幼儿园，让孩子真正享受从幼儿园到小学、初中、高中一站式全程教育配套，让您的孩子在浓厚人文氛围濡染下健康成长，赢在人生起跑线上。繁华之上——25万方商业配套  一站式生活享受佳源巴黎都市除了周边拥有成熟的学区、市政配套、公园配套，小区项目还规划了25万方一站式商业购物中心，包括老佛爷时尚购物中心、香榭丽舍特色步行街、风情街、办公楼和星级养老公寓等业态等，汇聚了风味美食街、大型超市、商业广场、室内菜场、娱乐休闲会所、五星级酒店等业态，让业主真正享受“出则繁华，入则宁静”的便捷生活。科技之上——智能化家居的终极享受  佳源巴黎都市引进了国内先进的智能化厨房系统，打造快乐厨房，通过接入网络及数字电视系统，数百种菜谱做法、闹钟设置、数字电视播放等，让业主的厨房更有快乐的滋味。智能化科技除基础防盗功能外，还设置了背景音乐系统、电子信报箱、门禁感应系统、室内安防报警系统等，建筑用材上设置了新风和吸尘系统，引领高品质的舒适生活。品质之上——人车绝对分流  五星级酒店配套的地下景观车库佳源巴黎都市秉承“车在地下走，人在花中游”的人车绝对分流的交通原则，通过配上“树大、绿多、花丛、起伏”的社区景观，安全舒适。同时精装修的地下景观车库，采用顶采光、侧采光及下沉式采光等多种手法，将阳光、空气引入车库，打造出全明的地下空间，特别配套引入净菜超市和洗车房，为业主将来的生活提供无微不至的配套服务。尊贵之上——五星级物业服务，量身定制，尊崇礼遇巴黎都市的物业聘请国家一级资质的浙江佳源物业管理有限公司进行管理。除为业主提供高标准的基础物业服务之外，还将为其提供在普通社区无法享受到的量身定制的服务，如便捷家政服务、健康战略联盟、幼少儿托管服务、一站式的婚庆服务、汽车清洗和美容服务、净菜超市和便利店服务、金钥匙管家、视线文化沙龙等特色服务，业主入住后享受的是五星级的酒店式服务，充分体现业主居住在巴黎都市的价值感、成就感和尊崇感。○名流会所中心：开展丰富的小区节日文化活动，体现小区和谐生活。○社工服务中心：幼儿托管、少儿课外托管，为儿童提供专业服务。○家政服务中心：提供家庭清洁、绿化、租赁、特约维修、介绍家教、保姆、上门收、送洗衣物等日常家政服务。○婚庆服务中心：会所内设婚庆礼堂，提供一站式婚庆服务。○健康战略联盟：物业专门配置医药急救药品，并定期与社区医院合作，组织开展以“健康”为主题的社区活动。○视线文化沙龙：巴黎都市触目所及的视线范围内都有流动的文化不断涌现。○资产管理中心：为社区居民提供全程代租、代管及理财等服务。○汽车清洗、美容服务：为社区居民提供专业汽车清洗、护理服务。○敬老养老服务：百米星级养老公寓配备专业营养师和私家菜厨师、医务人员、心理辅导师等班组，为老人提供餐饮、陪护、保健等关怀服务。','50','1','0','','0');
INSERT INTO jh_home VALUES ('14','7','3','','中海·滨湖公馆','demo/photo/201502/20150214_60D7E3DE2A209AE7B64653A3D5036337.jpg','','中海宏洋置业（合肥）有限公司[相关网站]','','7700','','0000-00-00','','','滨湖新区徽州大道与云谷路交叉口向东500米 ','0','0','0','0','中海·滨湖公馆位于滨湖核心板块，占地面积约320亩，建筑面积约65万平米，涵盖高层住宅、别墅、写字楼和商业等多种业态。1、大湖名城  省府中心中海滨湖公馆位于省府核心区域，紧邻金融总部基地和文旅综合体，周边五大公园环绕、巢湖风景区咫尺即达。2、金融总部  精英邻里 位居工行、建行、中行、农行、交行等金融总部基地的核心，未来将与数十万金融精英为邻。3、五园一湖  氧生鲜境金斗公园、方兴湖公园、塘西河公园、滨湖湿地公园、牛角大圩生态公园五园环绕，800里巢湖美景一览无余，畅享天然氧吧。4、双轨交通  畅通全城1号线、5号线双地铁站5分钟步行直达；方兴大道、徽州大道等四横三纵主干道极速通达安徽全省。5、名校环伺  优享教育项目西北角政府规划建设九年制学校，周边汇聚合肥一中、四十六中、师范附小等全省优质教育资源，优享一站式教育。6、商业中心  繁华相拥 滨湖板块将建成数百万方商务休闲娱乐中心，未来项目周边商业繁华，品牌云集，无论生活还是休闲娱乐，一站式尽享。 　　中海滨湖公馆地处滨湖中央核心区，建筑面积约65万平米，涵盖高层住宅、别墅、写字楼和商业等多种业态。占据合肥国际金融总部基地核心稀缺地块，未来将与数十万金融精英为邻。周边有金斗公园、方兴湖公园、塘西河公园、滨湖湿地公园、牛角大圩生态公园，五园一湖环抱其中，800里巢湖美景近在咫尺。1号线、5号线双地铁站5分钟步行直达，方兴大道、徽州大道等四横三纵主干道极速通达安徽全省。项目西北角政府规划建设九年制学校，周边汇聚合肥一中、四十六中、师范附小等全省优质教育资源，优享一站式教育。滨湖板块将建成数百万方商务休闲娱乐中心，未来项目周边商业繁华，品牌云集，生活购物一站式尽享。户型有88-164㎡全能户型，满足每个家庭的不同居住需求。','50','1','0','','0');
INSERT INTO jh_home VALUES ('15','7','10','','华润熙云府','demo/photo/201502/20150214_39350D0A0B6D87DF974E21863201FF70.jpg','','合肥新站华润置地开发有限公司','','6600','','0000-00-00','','','新站区淮南路与凤山路交口东南 ','0','0','0','1','华润2014全新人居大作——华润熙云府将洋房、高层与商业街融为一体，感受生活之轻松惬意；1.8万方英伦格调街区汇集华润品牌资源，将生活配套升级为时尚缤纷场所；熙云府26万方人文居所，十年风华人生新站。华润旗下著名品牌-苏果超市已与熙云府成功签约，正式入驻。新站重点建设学校-淮合小学及自配幼教机构让下一代的成长教育无忧无虑；行业领先的华润物业更可为业主提供100个全方位的细节呵护。','50','1','0','','0');
INSERT INTO jh_home VALUES ('16','7','7','','长虹世纪荣廷','demo/photo/201502/20150214_C0B26702D1F303D004329B06628BE6FE.jpg','','安徽鑫昊等离子显示器件有限公司','','6700','','0000-00-00','','','新站区铜陵北路以东，天水路以南 ','0','0','0','0','长虹世纪荣廷是新站区首席大盘，世界品牌500强企业四川长虹旗下长虹置业进军合肥的首席大作，铜陵北路以东，天水路以南，傲居区域内核心位置，占地面积约278亩，总建面达80万方，绿化率高达40%以上，建筑密度低于25% ，绝佳规划奠定品质根基。长虹世纪荣廷天赋臻境，生态绝佳。拥揽天水公园、新海公园、生态公园、瑶海公园四大园景。举步可达乐活广场、世纪天乐商业广场、永辉超市、合家福超市等大型商业中心，10分钟执掌繁华便利。长虹世纪荣廷新古典主义风格建筑高贵挺拔，纯法式园林景观浪漫典雅，自身社区万余平米商业街区为您创造精彩生活，80万方品质大盘，为合肥人再献优质生活！','50','1','0','','0');
INSERT INTO jh_home VALUES ('17','7','3','','绿城翡翠湖玫瑰园','demo/photo/201502/20150214_BE2A82DC4EA7BA149FC923303DBF5F1F.jpg','','安徽绿城玫瑰园房地产开发有限公司','','8600','','0000-00-00','','','经开区繁华大道与云外路交口西南角 ','0','0','0','0','绿城翡翠湖玫瑰园项目位于合肥市中心城区西南部，紧邻翡翠湖，属于翡翠湖板块，根据合肥市“141”的发展战略，翡翠湖版块属于西南组团的发展规划。项目东至云外路，西接九龙路和丹霞磬苑，北至繁华大道，南临环翠路。绿城翡翠湖玫瑰园坐落在翡翠湖风景区，享有2000亩的翡翠湖和翡翠公园。周边大学林立，在项目的东南和西南方向各有一所国家211工程的重点高校，合肥工业大学和安徽大学。绿城翡翠湖玫瑰园项目分二部分开发，项目南区为合院别墅、法式官邸，北区为湖景高层。总占地500亩，总建筑面积约86万㎡。绿城翡翠湖玫瑰园法式合院别墅综合法式排屋与法式别墅的优点，设计更具有隐私性，把客人房，客厅、家庭厅，自家卧室自然分隔开来，形成主人安静的生活空间，利用地下室设置工人房，娱乐室，多功能厅。绿城翡翠湖玫瑰园法式官邸仅4栋，“十字型”的平面规划，将功能空间划分为四个区域。绿城翡翠湖玫瑰园湖景公馆：高层公寓建筑群以点式高层和板式高层单体组成，高层住宅顶部退台设计为复式房型，高层车道全部采用地下通行，社区交通组织采用组团式的人车分流模式。绿城翡翠湖玫瑰园主力户型： 合院别墅560-850㎡；法式官邸230-700㎡ ；湖景公馆140-300㎡。 绿城翡翠湖玫瑰园合院别墅一期2012年2月交付；法式官邸1#、2#2012月12月31日交付；湖景公馆1号、11号、12号楼2013年9月30日交付。','50','1','0','','0');
INSERT INTO jh_home VALUES ('18','7','11','','保利香槟国际','demo/photo/201502/20150214_984D802E8CB712D72CF1405C08159DAC.jpg','','合肥保利房地产开发有限公司','','10200','','0000-00-00','','','政务区集贤路与习友路交汇处 ','15','0','0','0','保利香槟国际位于合肥市政务区集贤路与习友路交汇处西北角，占地面积272.85亩（其中含小学用地面积不小于34.5亩），建筑面积70万方，政务区70万方纯住宅香槟社区，土地出让年限为70年，容积率≤3.0，建筑密度≤22%，绿地(化)率≥40%。保利香槟国际规划总户数约5000户，85-106㎡的经典户型，是政务区规模最大的精装修住宅社区。保利香槟国际由美国HOOP建筑设计、国际怡境景观(香港)设计、(加拿大)毕路德国际、北京紫香舸国际艺术顾问四家公司打造，采用Art-Deco古典主义建筑风格，3000㎡大规模幼儿园，15500㎡小学名校，15000㎡法式风情商业街，1600㎡香槟生活馆，一级资质的保利物业。保利香槟国际与合肥市政府、安徽日报社、广电局等政府机构，保利大剧院、奥体中心、文博园、赖少其艺术馆行等市政配套为邻，享政务区成熟文化体育配套。项目周边翠庭园实验小学、50中新区、新八中等重点中小学校云集，周边还有匡河景观带、大蜀山、天鹅湖等风景区。','50','1','0','','0');
INSERT INTO jh_home VALUES ('19','7','5','','融侨悦城','demo/photo/201502/20150214_576214079CFE7F9800CF54573D0FE474.jpg','','融侨集团合肥置业有限公司','','7200','','0000-00-00','','','庐阳区阜阳北路与凌湖路交口东北角 ','1','0','0','0','融侨悦城坐落于庐阳区阜阳北路与凌湖路交口东北角，占地293亩，总建筑面积约47万方。融侨悦城紧邻南北交通大动脉阜阳路，距老城区不到6公里，5分钟出入市中心繁华地带。家门口就是公交枢纽，沿阜阳北路有47路、117路、7路等多条公交线路抵达市内各地。规划中的5号线地铁站也在项目周边，步行10分钟轻松到达。融侨悦城地处庐阳区炙手可热的名校学区，升值潜力巨大，步行五分钟范围内，就有合肥四十五中分校、合肥南门小学分校、合肥六安路小学分校等市重点学校，一站式名校教育，让孩子赢在起点。融侨悦城自有500米沿街商铺、近6万方商业城，大型商超、美食餐厅、KTV、名牌专卖店、主题街区等商业配套近在眼前，吃、喝、玩、乐、购应有尽有。融侨悦城拥有2.6的低容积率和41%的高绿化率，园林整体布局强调有序严谨，尺度阔达，轴线深远，从而形成了一种对称式的景观空间组合。26栋ART DECO风格高层，铺排其间，沿袭了典雅、简约的法式现代建筑特色。隔街对望202亩的菱湖公园，住在融侨悦城，就像在梦幻花园中生活一般。融侨悦城拥有74㎡—123㎡多样精品户型，无论你是单身贵族、新婚夫妻、三口之家还是三代同堂，都能挑到适合你的幸福居所。融侨集团，25年伟大历程、50余项目筑造经验、强大的资金实力与品牌背景，为万千家庭构建理想城市生活。从福州到合肥，全国愈15万业主荣耀共鉴。融侨物业，成立于1997年，国家一级资质的全国百强物业，用多年醇熟经验为您带来舒适、安全的管家式服务。','50','1','0','','0');
INSERT INTO jh_home VALUES ('20','7','9','','北城世纪城','demo/photo/201502/20150214_8884D36F097D751607EDAB70523D0C45.jpg','','合肥世纪城置业有限责任公司','','5200','','0000-00-00','','','长丰北城新区蒙城北路与濛河路交叉口 ','4','0','0','0','北城世纪城，是由世纪金源集团继滨湖世纪城之后在合肥精心打造的第二个超大复合型地产项目,目前项目规划共三期，总建筑面积约630万平方米。项目内各种配套和物业形态丰富，汇集百年名校合肥42中（九年一贯制学校，2013年9月份已正式开学）、精品住宅、30万平米超大型购物中心、超五星级标准酒店、精装修酒店公寓、公寓式写字楼、高端写字楼、徽派休闲古街、商业步行街、国际标准恒温泳池等，整个社区规划居住人口达15万人左右。北城世纪城项目一期净用地面积近1000亩，建筑面积约256万平米，其中住宅总套数有16000多套。共分为七个园区，依次为帝徽苑、国徽苑、鸿徽苑、腾徽苑、冠徽苑、祥徽苑、颐徽苑。其中祥徽苑为五星级酒店、精装修酒店公寓、写字楼用地；帝徽苑内有九年一贯制合肥42中；国徽苑和冠徽苑中各有一所幼儿园。一期地块于2011年3月份动工，现已全部交付使用。整体地块东临城市中轴主干道蒙城北路，西至生态绿色长廊，南临梅冲湖，北靠滁河干渠。北城世纪城项目二期净用地面积1000余亩，总建筑面积约260万平米，住宅总套数约16000多套。也分为七个园区，依次为和徽苑、鑫徽苑、泽徽苑、吉徽苑、瑞徽苑、裕徽苑、锦徽苑。其中锦徽苑为30万平米超大型购物中心用地，另二期建有中、小学校各一所。二期地块于2012年12月份动工，计划2014年底全部建成。整体地块东至兴隆路，西接城市主干道蒙城北路，南临滁河干渠，北到艾亭路（临近合肥绕城高速）。北城世纪城项目三期净用地面积近600亩，总建筑面积约110万平米，住宅总套数约11000多套。共分为三个园区，规划有学校一所。三期地块于2013年9月份动工，预计2015年底全部建成。','50','1','0','','0');
DROP TABLE IF EXISTS jh_home_attr;
CREATE TABLE `jh_home_attr` (
  `home_id` mediumint(8) NOT NULL DEFAULT '0',
  `attr_id` mediumint(8) DEFAULT '0',
  `attr_value_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`home_id`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_home_package;
CREATE TABLE `jh_home_package` (
  `package_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT '',
  `tuan_id` mediumint(8) DEFAULT NULL,
  `huxing_id` mediumint(8) DEFAULT NULL,
  `price` varchar(15) DEFAULT NULL,
  `total_price` varchar(15) DEFAULT NULL,
  `clientip` char(15) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

INSERT INTO jh_home_package VALUES ('1','今朝北城，团装钜惠','1','414','688','86800','127.0.0.1','1423899082');
INSERT INTO jh_home_package VALUES ('2','今朝北城，团装钜惠','1','428','588','76800','127.0.0.1','1423899105');
INSERT INTO jh_home_package VALUES ('3','保利香槟新春特惠-青鸟装饰','2','380','488','110000','127.0.0.1','1423900273');
INSERT INTO jh_home_package VALUES ('4','保利香槟新春特惠-青鸟装饰','2','381','588','98600','127.0.0.1','1423900334');
INSERT INTO jh_home_package VALUES ('5','滨湖万科团装活动','4','147','600','128000','127.0.0.1','1423901799');
DROP TABLE IF EXISTS jh_home_photo;
CREATE TABLE `jh_home_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `home_id` mediumint(8) DEFAULT '0',
  `type` tinyint(1) DEFAULT '1',
  `title` varchar(150) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `size` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`),
  KEY `orderby` (`orderby`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=457 DEFAULT CHARSET=utf8 AUTO_INCREMENT=457;

INSERT INTO jh_home_photo VALUES ('1','2','1','1','demo/homephoto/201502/20150214_CC4A9D4A2077F9998AA5975D35599B5F.jpg','123449','50','1423884810');
INSERT INTO jh_home_photo VALUES ('2','1','1','1','demo/homephoto/201502/20150214_2ACCB49CCA6E633E572CD5C0BEFDA33E.jpg','393484','50','1423884810');
INSERT INTO jh_home_photo VALUES ('3','2','1','2','demo/homephoto/201502/20150214_6240CF7C6DC05398D578700B55973929.jpg','139675','50','1423884810');
INSERT INTO jh_home_photo VALUES ('4','2','1','3','demo/homephoto/201502/20150214_99AB5A43D9AFA4365D79E176C79CF3B2.jpg','129517','50','1423884810');
INSERT INTO jh_home_photo VALUES ('5','1','1','2','demo/homephoto/201502/20150214_3FAD46425E5ACDF9DF2E2FC8E16AC76D.jpg','397841','50','1423884810');
INSERT INTO jh_home_photo VALUES ('6','2','1','4','demo/homephoto/201502/20150214_02916536D1731216BB5C70EBB0F3ABC0.jpg','127912','50','1423884810');
INSERT INTO jh_home_photo VALUES ('7','2','1','5','demo/homephoto/201502/20150214_FCCB5692BE6FAEC72D55844F859CE76E.jpg','178704','50','1423884810');
INSERT INTO jh_home_photo VALUES ('8','1','1','3','demo/homephoto/201502/20150214_2D37D3C60782BB999D4A678FE4E14DA1.jpg','439985','50','1423884810');
INSERT INTO jh_home_photo VALUES ('9','2','1','6','demo/homephoto/201502/20150214_5829AABA488A9DC2CE528568B728FA9B.jpg','167578','50','1423884810');
INSERT INTO jh_home_photo VALUES ('10','1','1','4','demo/homephoto/201502/20150214_3D32C3F2CEB00332FB01ECA4743B349F.jpg','421114','50','1423884810');
INSERT INTO jh_home_photo VALUES ('11','1','1','5','demo/homephoto/201502/20150214_DF5BAF07D62611CA7213A34475A72FC4.jpg','420075','50','1423884810');
INSERT INTO jh_home_photo VALUES ('12','2','1','7','demo/homephoto/201502/20150214_B05F2458F3FDAA45EB237B846303D983.jpg','184531','50','1423884810');
INSERT INTO jh_home_photo VALUES ('13','2','1','8','demo/homephoto/201502/20150214_A1FBE70F985BFEE7E744F73703040FF3.jpg','171120','50','1423884810');
INSERT INTO jh_home_photo VALUES ('14','1','1','6','demo/homephoto/201502/20150214_909466DAEE79761B61EF876455D351BD.jpg','409011','50','1423884810');
INSERT INTO jh_home_photo VALUES ('15','2','1','9','demo/homephoto/201502/20150214_AE4753F3562058FBEB774D4A4272281F.jpg','147347','50','1423884810');
INSERT INTO jh_home_photo VALUES ('16','1','1','7','demo/homephoto/201502/20150214_DFDC33CBA03F06F940D3919265213C61.jpg','412319','50','1423884810');
INSERT INTO jh_home_photo VALUES ('17','2','1','10','demo/homephoto/201502/20150214_E279CD57A2CEF22F37FCEF3089AA32A4.jpg','148317','50','1423884810');
INSERT INTO jh_home_photo VALUES ('18','2','1','11','demo/homephoto/201502/20150214_0F2E2EFFADE9E003D5E064F56FB5BE71.jpg','166730','50','1423884810');
INSERT INTO jh_home_photo VALUES ('19','1','1','8','demo/homephoto/201502/20150214_A171F83F080D51C55C008827B32A6AB3.jpg','431984','50','1423884810');
INSERT INTO jh_home_photo VALUES ('20','2','1','12','demo/homephoto/201502/20150214_E1560656B7CC7ABB3FFB0335041B1748.jpg','218108','50','1423884810');
INSERT INTO jh_home_photo VALUES ('21','1','2','1','demo/homephoto/201502/20150214_18A73826B703344609FA3A1CD4507F01.jpg','288401','50','1423884810');
INSERT INTO jh_home_photo VALUES ('22','2','2','1','demo/homephoto/201502/20150214_CFE104708BFF357EAD7A208B265E7FA4.jpg','211673','50','1423884810');
INSERT INTO jh_home_photo VALUES ('23','2','2','2','demo/homephoto/201502/20150214_943E526E0F0BA98D06E72740D83CCE04.jpg','680972','50','1423884810');
INSERT INTO jh_home_photo VALUES ('24','1','2','2','demo/homephoto/201502/20150214_C2A5918AD72B11679F985BDA0285668C.jpg','325322','50','1423884810');
INSERT INTO jh_home_photo VALUES ('25','2','2','3','demo/homephoto/201502/20150214_00D1B79988FEB168B29C2C5E50BA9EA8.jpg','254805','50','1423884810');
INSERT INTO jh_home_photo VALUES ('26','1','2','3','demo/homephoto/201502/20150214_C84C0A47BB4D038519C01C012A577B11.jpg','258818','50','1423884810');
INSERT INTO jh_home_photo VALUES ('27','2','2','4','demo/homephoto/201502/20150214_E2BA66992EB15ECF37AD6347BBA315C3.jpg','731545','50','1423884810');
INSERT INTO jh_home_photo VALUES ('28','1','2','4','demo/homephoto/201502/20150214_58852B9D46BD4786394EB942E578E81E.jpg','244329','50','1423884810');
INSERT INTO jh_home_photo VALUES ('29','2','2','5','demo/homephoto/201502/20150214_9E7766A6EE5C8418AB9219F0184538B1.jpg','642670','50','1423884810');
INSERT INTO jh_home_photo VALUES ('30','2','2','6','demo/homephoto/201502/20150214_4B5BD7A564D10A447C6DBC79670BD93D.jpg','259761','50','1423884810');
INSERT INTO jh_home_photo VALUES ('31','1','2','5','demo/homephoto/201502/20150214_58E9EE5969DCE187C89F221935C554F7.jpg','271056','50','1423884810');
INSERT INTO jh_home_photo VALUES ('32','2','2','7','demo/homephoto/201502/20150214_F546024088E2DFBD10F356400249FF46.jpg','277444','50','1423884810');
INSERT INTO jh_home_photo VALUES ('33','2','2','8','demo/homephoto/201502/20150214_D5F0E2DF5502205B12E2E698B4A1C055.jpg','241435','50','1423884810');
INSERT INTO jh_home_photo VALUES ('34','1','2','6','demo/homephoto/201502/20150214_1A7766A68FC9C08BD05AA95749E16311.jpg','269763','50','1423884810');
INSERT INTO jh_home_photo VALUES ('35','2','2','9','demo/homephoto/201502/20150214_B36CE79A9F821ACB2637215A22B5BA97.jpg','648352','50','1423884810');
INSERT INTO jh_home_photo VALUES ('36','2','2','10','demo/homephoto/201502/20150214_FE39E8476A4026A2BDC46D05A7094B14.jpg','266978','50','1423884810');
INSERT INTO jh_home_photo VALUES ('37','1','2','7','demo/homephoto/201502/20150214_13650C8D9A71B95F0F2D8938B1B958E4.jpg','276529','50','1423884810');
INSERT INTO jh_home_photo VALUES ('38','2','2','11','demo/homephoto/201502/20150214_02911070BD36F696C1FBDA51F4A8D113.jpg','223238','50','1423884810');
INSERT INTO jh_home_photo VALUES ('39','2','2','12','demo/homephoto/201502/20150214_02E847490940F779901A5773171A73B4.jpg','664386','50','1423884810');
INSERT INTO jh_home_photo VALUES ('40','1','2','8','demo/homephoto/201502/20150214_33634D1EE20A07BDC2F974C2BE965235.jpg','255090','50','1423884810');
INSERT INTO jh_home_photo VALUES ('41','1','2','9','demo/homephoto/201502/20150214_1BDB83C6FCDF13C01F7CBBCB5CAE245D.jpg','301757','50','1423884810');
INSERT INTO jh_home_photo VALUES ('42','3','1','1','demo/homephoto/201502/20150214_E2A8B3071F779EECE57B37D37CFFC43C.jpg','102964','50','1423884825');
INSERT INTO jh_home_photo VALUES ('43','3','1','2','demo/homephoto/201502/20150214_3BBC92CFA563B6823FF4D0AF74C11DBA.jpg','107377','50','1423884825');
INSERT INTO jh_home_photo VALUES ('44','1','2','10','demo/homephoto/201502/20150214_01F3AA8ACE5813A987999B3EB350C96F.jpg','308087','50','1423884810');
INSERT INTO jh_home_photo VALUES ('45','3','1','3','demo/homephoto/201502/20150214_40D6D2381E8CEFEA5C6DA5532B2CD37E.jpg','97347','50','1423884825');
INSERT INTO jh_home_photo VALUES ('46','1','2','11','demo/homephoto/201502/20150214_A82623254C7468CDF4F9E86FEEEB1A48.jpg','294919','50','1423884810');
INSERT INTO jh_home_photo VALUES ('47','3','1','4','demo/homephoto/201502/20150214_9FB1371432C4BD4E0A19F2186902C109.jpg','107572','50','1423884825');
INSERT INTO jh_home_photo VALUES ('48','3','1','5','demo/homephoto/201502/20150214_235843CDEBC3666DA2CC11ACB9FE3527.jpg','112067','50','1423884825');
INSERT INTO jh_home_photo VALUES ('49','1','2','12','demo/homephoto/201502/20150214_1852EC5A39A1ABDA20D457C5D1F0C61A.jpg','267865','50','1423884810');
INSERT INTO jh_home_photo VALUES ('50','3','1','6','demo/homephoto/201502/20150214_EF592EA2107BBF54CEA7E1A5D58AA0C5.jpg','98639','50','1423884825');
INSERT INTO jh_home_photo VALUES ('51','3','1','7','demo/homephoto/201502/20150214_C5481E9A3B20C9158B8E501E1274F309.jpg','123100','50','1423884825');
INSERT INTO jh_home_photo VALUES ('52','3','1','8','demo/homephoto/201502/20150214_57C7BF93DAB3788223A77F4E8FFD7B48.jpg','106272','50','1423884825');
INSERT INTO jh_home_photo VALUES ('53','4','1','1','demo/homephoto/201502/20150214_CF2BDD51DFE5E36F6139F17D7949DCDC.jpg','142269','50','1423884829');
INSERT INTO jh_home_photo VALUES ('54','3','2','1','demo/homephoto/201502/20150214_D742CB3F4CAEDD0449191706BD57A216.jpg','124577','50','1423884825');
INSERT INTO jh_home_photo VALUES ('55','4','1','2','demo/homephoto/201502/20150214_48C9AEA313355BA59AB27101479AB77F.jpg','144019','50','1423884829');
INSERT INTO jh_home_photo VALUES ('56','3','2','2','demo/homephoto/201502/20150214_4CF5E7933AE8A61D541116570CEDEE6B.jpg','86878','50','1423884825');
INSERT INTO jh_home_photo VALUES ('57','4','1','3','demo/homephoto/201502/20150214_D09D76192AAE9EC6B383D63F00FD19CC.jpg','129166','50','1423884829');
INSERT INTO jh_home_photo VALUES ('58','4','1','4','demo/homephoto/201502/20150214_0243C9D96F0F70F5C061A1595D356D5F.jpg','125712','50','1423884829');
INSERT INTO jh_home_photo VALUES ('59','3','2','3','demo/homephoto/201502/20150214_5B450943BB8CAFC98133F7776A1483A8.jpg','186811','50','1423884825');
INSERT INTO jh_home_photo VALUES ('60','4','1','5','demo/homephoto/201502/20150214_F087DA2B714696D264B8FD81C3931FA4.jpg','129618','50','1423884829');
INSERT INTO jh_home_photo VALUES ('61','4','1','6','demo/homephoto/201502/20150214_0AA6F5727A235196A736D630F2EF7853.jpg','115923','50','1423884829');
INSERT INTO jh_home_photo VALUES ('62','3','2','4','demo/homephoto/201502/20150214_A7E5706937D77AFD2D73B946052B45C5.jpg','182408','50','1423884825');
INSERT INTO jh_home_photo VALUES ('63','4','1','7','demo/homephoto/201502/20150214_920FD77278170A406703E4ECE8A82C5E.jpg','114700','50','1423884829');
INSERT INTO jh_home_photo VALUES ('64','3','2','5','demo/homephoto/201502/20150214_8133E2ECC678BEF037D97468D279C77E.jpg','242513','50','1423884825');
INSERT INTO jh_home_photo VALUES ('65','4','1','8','demo/homephoto/201502/20150214_BA1C014AF7A82A5A148ECAC2A3494995.jpg','113651','50','1423884829');
INSERT INTO jh_home_photo VALUES ('66','4','1','9','demo/homephoto/201502/20150214_0B4A243488861657A6A89491749B8696.jpg','108336','50','1423884829');
INSERT INTO jh_home_photo VALUES ('67','3','2','6','demo/homephoto/201502/20150214_AAB286B357D5F30ABBA297E5235DDB9A.jpg','124465','50','1423884825');
INSERT INTO jh_home_photo VALUES ('68','4','1','10','demo/homephoto/201502/20150214_E31ABADB9B88F9CD10D99ABADB421289.jpg','108039','50','1423884829');
INSERT INTO jh_home_photo VALUES ('69','4','2','1','demo/homephoto/201502/20150214_B78CAE9DC9B2CCF16994992F5325F345.jpg','140993','50','1423884829');
INSERT INTO jh_home_photo VALUES ('70','3','2','7','demo/homephoto/201502/20150214_188EA613E1F524C8D02C1474154FBF33.jpg','154853','50','1423884825');
INSERT INTO jh_home_photo VALUES ('71','4','2','2','demo/homephoto/201502/20150214_341959E721A8C660964D51F0FFC7246B.jpg','126658','50','1423884829');
INSERT INTO jh_home_photo VALUES ('72','4','2','3','demo/homephoto/201502/20150214_F244D7DB7CC2C49E75DAEFD275BC6150.jpg','100095','50','1423884829');
INSERT INTO jh_home_photo VALUES ('73','3','2','8','demo/homephoto/201502/20150214_7680479E7DA03204F6F58C5B6DA2E9B8.jpg','203564','50','1423884825');
INSERT INTO jh_home_photo VALUES ('74','3','2','9','demo/homephoto/201502/20150214_C3DD34406A06B84BA90C46DC05513EC9.jpg','208327','50','1423884825');
INSERT INTO jh_home_photo VALUES ('75','4','2','4','demo/homephoto/201502/20150214_D0772BD1CE780950CCF4BC3303DAEAC9.jpg','119303','50','1423884829');
INSERT INTO jh_home_photo VALUES ('76','3','2','10','demo/homephoto/201502/20150214_C7C6DEAD5BA529F0D42476DD8821455C.jpg','86189','50','1423884825');
INSERT INTO jh_home_photo VALUES ('77','4','2','5','demo/homephoto/201502/20150214_12E3F2FED9F5381A1EA63E0C1DBFC7E0.jpg','111011','50','1423884829');
INSERT INTO jh_home_photo VALUES ('78','3','2','11','demo/homephoto/201502/20150214_4F54632685417BF5065BD8FD1B76BCCA.jpg','151796','50','1423884825');
INSERT INTO jh_home_photo VALUES ('79','4','2','6','demo/homephoto/201502/20150214_A8ADD5AD864FD46FE122FBBBAB6B037D.jpg','104374','50','1423884829');
INSERT INTO jh_home_photo VALUES ('80','3','2','12','demo/homephoto/201502/20150214_4AB9D2C9AD6E3D4E3C1B687B1897EA18.jpg','159127','50','1423884825');
INSERT INTO jh_home_photo VALUES ('81','4','2','7','demo/homephoto/201502/20150214_B971D78856382468BA962A3A5C62241B.jpg','125271','50','1423884829');
INSERT INTO jh_home_photo VALUES ('82','4','2','8','demo/homephoto/201502/20150214_DF8396B9833FA49CD0EB80BC825F8206.jpg','120690','50','1423884829');
INSERT INTO jh_home_photo VALUES ('83','4','2','9','demo/homephoto/201502/20150214_293C15126A8EDACF9FC6E58834695A1A.jpg','118151','50','1423884829');
INSERT INTO jh_home_photo VALUES ('84','5','1','1','demo/homephoto/201502/20150214_480284D251FBBAD3451A0E29AD96CA21.jpg','360922','50','1423884838');
INSERT INTO jh_home_photo VALUES ('85','4','2','10','demo/homephoto/201502/20150214_C5F8844FA12C789DD00B3A11213B25BF.jpg','82672','50','1423884829');
INSERT INTO jh_home_photo VALUES ('86','4','2','11','demo/homephoto/201502/20150214_7882FE4A239143D16BC6ACC5E45C6028.jpg','133422','50','1423884829');
INSERT INTO jh_home_photo VALUES ('87','5','1','2','demo/homephoto/201502/20150214_057E1066695D1BF41A960D065A1F0699.jpg','378805','50','1423884838');
INSERT INTO jh_home_photo VALUES ('88','4','2','12','demo/homephoto/201502/20150214_E5446D4C4024BA9743E6D4AD1DA12D5D.jpg','151927','50','1423884829');
INSERT INTO jh_home_photo VALUES ('89','5','1','3','demo/homephoto/201502/20150214_F74EC31C3AFDDFEE74AA5AAFCF6E6D4D.jpg','396644','50','1423884838');
INSERT INTO jh_home_photo VALUES ('90','5','1','4','demo/homephoto/201502/20150214_79DCCDD7C86EB9AA4497E7F60C0AA8FC.jpg','379624','50','1423884838');
INSERT INTO jh_home_photo VALUES ('91','6','1','1','demo/homephoto/201502/20150214_2756BD39913697AA5123108851A0ADE7.jpg','82423','50','1423884841');
INSERT INTO jh_home_photo VALUES ('92','5','1','5','demo/homephoto/201502/20150214_1D0FD1EC636343A701EEE1DC6386E1A9.jpg','366509','50','1423884838');
INSERT INTO jh_home_photo VALUES ('93','6','1','2','demo/homephoto/201502/20150214_C1F9B889C2C7AD05C82C0887AFE2AAF2.jpg','71733','50','1423884841');
INSERT INTO jh_home_photo VALUES ('94','5','1','6','demo/homephoto/201502/20150214_F392B53EFBDA7F1ECCD885A63A2408A7.jpg','350347','50','1423884838');
INSERT INTO jh_home_photo VALUES ('95','6','1','3','demo/homephoto/201502/20150214_0472F6F5ED44504E5996325F39A72539.jpg','96778','50','1423884841');
INSERT INTO jh_home_photo VALUES ('96','6','1','4','demo/homephoto/201502/20150214_4A3799832C93712E288005B14EF45C40.jpg','73636','50','1423884841');
INSERT INTO jh_home_photo VALUES ('97','5','1','7','demo/homephoto/201502/20150214_3127EBAFBF265FEFE7AC8CE2A1C1481D.jpg','363305','50','1423884838');
INSERT INTO jh_home_photo VALUES ('98','6','1','5','demo/homephoto/201502/20150214_1297E92E949B8362827038E778B164B0.jpg','479736','50','1423884841');
INSERT INTO jh_home_photo VALUES ('99','5','1','8','demo/homephoto/201502/20150214_9EDBA594CFB328E241A90CD0A634DF24.jpg','352968','50','1423884838');
INSERT INTO jh_home_photo VALUES ('100','6','1','6','demo/homephoto/201502/20150214_174E9617CB6DA67128EEE0946D20C29B.jpg','452231','50','1423884841');
INSERT INTO jh_home_photo VALUES ('101','5','1','9','demo/homephoto/201502/20150214_9A8EF9CFA62874358B9836C016BC532D.jpg','373510','50','1423884838');
INSERT INTO jh_home_photo VALUES ('102','6','1','7','demo/homephoto/201502/20150214_69B940052D13D087ABDFF90CB9BE3E66.jpg','153759','50','1423884841');
INSERT INTO jh_home_photo VALUES ('103','6','1','8','demo/homephoto/201502/20150214_459DEF4DFC56268BEB7D21FC163BB0E6.jpg','451752','50','1423884841');
INSERT INTO jh_home_photo VALUES ('104','5','1','10','demo/homephoto/201502/20150214_0CB80B43DCDEF319DFA5C6054AE6FE34.jpg','369261','50','1423884838');
INSERT INTO jh_home_photo VALUES ('105','6','1','9','demo/homephoto/201502/20150214_A717836FA3EC04D15313E8C9ACBB4B35.jpg','451768','50','1423884841');
INSERT INTO jh_home_photo VALUES ('106','5','1','11','demo/homephoto/201502/20150214_4029E174327816C1A1107BA19B02A527.jpg','380124','50','1423884838');
INSERT INTO jh_home_photo VALUES ('107','5','1','12','demo/homephoto/201502/20150214_D3CD8011563B3A1A02ED84B2427BE9F4.jpg','73415','50','1423884838');
INSERT INTO jh_home_photo VALUES ('108','6','1','10','demo/homephoto/201502/20150214_008A9863F561CA873574C1DF8E8E56EE.jpg','453061','50','1423884841');
INSERT INTO jh_home_photo VALUES ('109','5','2','1','demo/homephoto/201502/20150214_784791A7062482886491AD80D9AD25C3.jpg','533561','50','1423884838');
INSERT INTO jh_home_photo VALUES ('110','6','1','11','demo/homephoto/201502/20150214_B6FC39A53394B2AA0A3FFBB6BF2E9319.jpg','483181','50','1423884841');
INSERT INTO jh_home_photo VALUES ('111','6','1','12','demo/homephoto/201502/20150214_381F090D35EDAB65337B41020D83A2AB.jpg','428548','50','1423884841');
INSERT INTO jh_home_photo VALUES ('112','5','2','2','demo/homephoto/201502/20150214_2827CBE99EBB80D410A869CFEEB2DEA9.jpg','631821','50','1423884838');
INSERT INTO jh_home_photo VALUES ('113','6','2','1','demo/homephoto/201502/20150214_9308DE52A906758C990DB66F39D34194.jpg','447414','50','1423884841');
INSERT INTO jh_home_photo VALUES ('114','5','2','3','demo/homephoto/201502/20150214_78DD39EC6F51118AAB8A7768509F5F79.jpg','423898','50','1423884838');
INSERT INTO jh_home_photo VALUES ('115','6','2','2','demo/homephoto/201502/20150214_8EE3C614BD7F36186CB84F7C2698A391.jpg','567603','50','1423884841');
INSERT INTO jh_home_photo VALUES ('116','5','2','4','demo/homephoto/201502/20150214_62D52E5ED1EA8F1B281DDFC17C253063.jpg','540817','50','1423884838');
INSERT INTO jh_home_photo VALUES ('117','5','2','5','demo/homephoto/201502/20150214_3DE9985607ABD082E7115265179444DE.jpg','555620','50','1423884838');
INSERT INTO jh_home_photo VALUES ('118','6','2','3','demo/homephoto/201502/20150214_F2FAF709C01AA31E9B773E2604F76F16.jpg','649855','50','1423884841');
INSERT INTO jh_home_photo VALUES ('119','5','2','6','demo/homephoto/201502/20150214_E51495FA0FC89E7B72223254BFC2E5AC.jpg','488291','50','1423884838');
INSERT INTO jh_home_photo VALUES ('120','6','2','4','demo/homephoto/201502/20150214_09FBDF353B83C857ED2C476B4A3F9643.jpg','567199','50','1423884841');
INSERT INTO jh_home_photo VALUES ('121','5','2','7','demo/homephoto/201502/20150214_25499DFCC66D96C9DF4460670ADA49FD.jpg','634982','50','1423884838');
INSERT INTO jh_home_photo VALUES ('122','6','2','5','demo/homephoto/201502/20150214_96F3045AC371E8C4DC2909CE7672861B.jpg','528282','50','1423884841');
INSERT INTO jh_home_photo VALUES ('123','5','2','8','demo/homephoto/201502/20150214_3D4578F088A7C32F51C9C513A25765C3.jpg','569525','50','1423884838');
INSERT INTO jh_home_photo VALUES ('124','6','2','6','demo/homephoto/201502/20150214_CFB6FF4A088063B3AE7682ED230C2B58.jpg','651353','50','1423884841');
INSERT INTO jh_home_photo VALUES ('125','5','2','9','demo/homephoto/201502/20150214_0058269AF30A103834AFF24574C3CFA0.jpg','643233','50','1423884838');
INSERT INTO jh_home_photo VALUES ('126','6','2','7','demo/homephoto/201502/20150214_19701481285DB48B7DEC384AEBEB67E9.jpg','679601','50','1423884841');
INSERT INTO jh_home_photo VALUES ('127','5','2','10','demo/homephoto/201502/20150214_CA36C885B6FED3B668FF986EB34D9603.jpg','654482','50','1423884838');
INSERT INTO jh_home_photo VALUES ('128','6','2','8','demo/homephoto/201502/20150214_2191CCBA227219C40CE80577223CC6D9.jpg','595048','50','1423884841');
INSERT INTO jh_home_photo VALUES ('129','5','2','11','demo/homephoto/201502/20150214_AE1184841DA7BF8AC753F873441A3A8E.jpg','631748','50','1423884838');
INSERT INTO jh_home_photo VALUES ('130','6','2','9','demo/homephoto/201502/20150214_D458C5BC5AFE0DEA176D53BDF9BC96CA.jpg','589389','50','1423884841');
INSERT INTO jh_home_photo VALUES ('131','5','2','12','demo/homephoto/201502/20150214_B5BA5E5A1FD991AF0CB4FA2ACDCE10CE.jpg','633217','50','1423884838');
INSERT INTO jh_home_photo VALUES ('132','6','2','10','demo/homephoto/201502/20150214_EB23103D4E1A595B6542B1D2166A02F4.jpg','435037','50','1423884841');
INSERT INTO jh_home_photo VALUES ('133','7','1','1','demo/homephoto/201502/20150214_9DD7D3975EF050A3EA5D5E3E1C1C99BC.jpg','181436','50','1423884856');
INSERT INTO jh_home_photo VALUES ('134','6','2','11','demo/homephoto/201502/20150214_3939B5B27232A88E86EA24CF70E344FE.jpg','717201','50','1423884841');
INSERT INTO jh_home_photo VALUES ('135','7','1','2','demo/homephoto/201502/20150214_7B9E046F8FEB4F2D7F9D7260D30BB300.jpg','209709','50','1423884856');
INSERT INTO jh_home_photo VALUES ('136','6','2','12','demo/homephoto/201502/20150214_EEC05363A0AA2C91294830417D3A2C61.jpg','357329','50','1423884841');
INSERT INTO jh_home_photo VALUES ('137','7','1','3','demo/homephoto/201502/20150214_4EF70306E73E3FC44985ED786D831DDD.jpg','75756','50','1423884856');
INSERT INTO jh_home_photo VALUES ('138','7','1','4','demo/homephoto/201502/20150214_17527C9A7B159D9A494FD18DACC7529C.jpg','280554','50','1423884856');
INSERT INTO jh_home_photo VALUES ('139','7','1','5','demo/homephoto/201502/20150214_A9CE6A589F7FEEF0727038A6E2AAFFE9.jpg','371757','50','1423884856');
INSERT INTO jh_home_photo VALUES ('140','8','1','1','demo/homephoto/201502/20150214_52194D44B3B473066A9BE78848935786.jpg','147944','50','1423884858');
INSERT INTO jh_home_photo VALUES ('141','8','1','2','demo/homephoto/201502/20150214_364855C2153450D3E89AE46044A71455.jpg','220557','50','1423884858');
INSERT INTO jh_home_photo VALUES ('142','7','1','6','demo/homephoto/201502/20150214_A663EBD512B5DE3C7B730A289A6F33FD.jpg','121216','50','1423884856');
INSERT INTO jh_home_photo VALUES ('143','8','1','3','demo/homephoto/201502/20150214_B91D40F59FDEBE245F9352A42A6BFF18.jpg','151183','50','1423884858');
INSERT INTO jh_home_photo VALUES ('144','7','1','7','demo/homephoto/201502/20150214_59630EED1476BDBD7EDFD5DD6875E006.jpg','97562','50','1423884856');
INSERT INTO jh_home_photo VALUES ('145','8','1','4','demo/homephoto/201502/20150214_C0EA46C7AB936EFF2BFD3A12CD1A70EE.jpg','86378','50','1423884858');
INSERT INTO jh_home_photo VALUES ('146','8','1','5','demo/homephoto/201502/20150214_4385CB45221C579B0A6DFAE0EE3C0186.jpg','88361','50','1423884858');
INSERT INTO jh_home_photo VALUES ('147','7','1','8','demo/homephoto/201502/20150214_4EA7783F27946AE81D87B6A1B95CA116.jpg','121525','50','1423884856');
INSERT INTO jh_home_photo VALUES ('148','8','1','6','demo/homephoto/201502/20150214_A86225681C8E8AEE086B5A2E189233D6.jpg','143842','50','1423884858');
INSERT INTO jh_home_photo VALUES ('149','7','1','9','demo/homephoto/201502/20150214_5DD82F9C6E1FF0544BFEDB7B2CB0885C.jpg','308053','50','1423884856');
INSERT INTO jh_home_photo VALUES ('150','7','1','10','demo/homephoto/201502/20150214_5C6CFE728F712E3EF017AC7720C75185.jpg','262772','50','1423884856');
INSERT INTO jh_home_photo VALUES ('151','8','1','7','demo/homephoto/201502/20150214_8959330637F7A478890180DFD4D23357.jpg','144701','50','1423884858');
INSERT INTO jh_home_photo VALUES ('152','7','1','11','demo/homephoto/201502/20150214_E9A40430D6A96FCBFC30D55CD679E61D.jpg','98481','50','1423884856');
INSERT INTO jh_home_photo VALUES ('153','8','1','8','demo/homephoto/201502/20150214_5E997835342DE3E757C75B7AEA4BDFBC.jpg','159101','50','1423884858');
INSERT INTO jh_home_photo VALUES ('154','8','1','9','demo/homephoto/201502/20150214_78F502F57024FEE44B815BD9773412B1.jpg','103777','50','1423884858');
INSERT INTO jh_home_photo VALUES ('155','7','1','12','demo/homephoto/201502/20150214_4B649A2BB450A46CCBDD547C49B64F08.jpg','117591','50','1423884856');
INSERT INTO jh_home_photo VALUES ('156','8','1','10','demo/homephoto/201502/20150214_6FC960EDA37611A03BE351064E876AE0.jpg','86456','50','1423884858');
INSERT INTO jh_home_photo VALUES ('157','7','2','1','demo/homephoto/201502/20150214_875449966DFC7B9368800BF56FC09554.jpg','348479','50','1423884856');
INSERT INTO jh_home_photo VALUES ('158','8','1','11','demo/homephoto/201502/20150214_92979DF4F60D0E5A417AE60AE1C51FA2.jpg','95083','50','1423884858');
INSERT INTO jh_home_photo VALUES ('159','8','1','12','demo/homephoto/201502/20150214_67955DC73B4A2D4BB45A750238EBACA3.jpg','99575','50','1423884858');
INSERT INTO jh_home_photo VALUES ('160','7','2','2','demo/homephoto/201502/20150214_86B428CC5B97F97D7853B5993E5AF452.jpg','330212','50','1423884856');
INSERT INTO jh_home_photo VALUES ('161','8','2','1','demo/homephoto/201502/20150214_50EB6B02C8AD89AD5DB1FDCAF026A087.jpg','88215','50','1423884858');
INSERT INTO jh_home_photo VALUES ('162','8','2','2','demo/homephoto/201502/20150214_8B71A6F3BD335AC4BD2C74A2104D24C1.jpg','146572','50','1423884858');
INSERT INTO jh_home_photo VALUES ('163','8','2','3','demo/homephoto/201502/20150214_42D2C05827DB74AD610F1065F3EDB748.jpg','69641','50','1423884858');
INSERT INTO jh_home_photo VALUES ('164','7','2','3','demo/homephoto/201502/20150214_49423CCB2D66CA87DD61D644F804A706.jpg','573933','50','1423884856');
INSERT INTO jh_home_photo VALUES ('165','8','2','4','demo/homephoto/201502/20150214_6566AA015E97FD1079EC531B97E667B6.jpg','133913','50','1423884858');
INSERT INTO jh_home_photo VALUES ('166','8','2','5','demo/homephoto/201502/20150214_251EEA94F32A0D2B02CA813DB8A58EFE.jpg','166050','50','1423884858');
INSERT INTO jh_home_photo VALUES ('167','7','2','4','demo/homephoto/201502/20150214_82C94B1626F6C7432EAD4F64CA59619F.jpg','547792','50','1423884856');
INSERT INTO jh_home_photo VALUES ('168','8','2','6','demo/homephoto/201502/20150214_CDF8992CF455ECDB6C5A220435026411.jpg','140530','50','1423884858');
INSERT INTO jh_home_photo VALUES ('169','8','2','7','demo/homephoto/201502/20150214_FE4BFAECC7FD904FBF24F9576D2EC22B.jpg','109600','50','1423884858');
INSERT INTO jh_home_photo VALUES ('170','7','2','5','demo/homephoto/201502/20150214_6514C7DF834885A9F41F1A8370B77614.jpg','493433','50','1423884856');
INSERT INTO jh_home_photo VALUES ('171','8','2','8','demo/homephoto/201502/20150214_ADAC4922E3876C4C6C5172C130256161.jpg','154386','50','1423884858');
INSERT INTO jh_home_photo VALUES ('172','7','2','6','demo/homephoto/201502/20150214_B4E077163CDE403054016AB71E9C5E70.jpg','463458','50','1423884856');
INSERT INTO jh_home_photo VALUES ('173','8','2','9','demo/homephoto/201502/20150214_A1E56A1FA59C41C572032D4E8410ABF9.jpg','146783','50','1423884858');
INSERT INTO jh_home_photo VALUES ('174','8','2','10','demo/homephoto/201502/20150214_4BB0E752B12DD28415C4B64002269B16.jpg','134837','50','1423884858');
INSERT INTO jh_home_photo VALUES ('175','7','2','7','demo/homephoto/201502/20150214_8CEFF7272F5ECF8F5DE43CFD12594B93.jpg','493072','50','1423884856');
INSERT INTO jh_home_photo VALUES ('176','8','2','11','demo/homephoto/201502/20150214_B7E3B36BE37294F14E6B532510F9C76B.jpg','178650','50','1423884858');
INSERT INTO jh_home_photo VALUES ('177','8','2','12','demo/homephoto/201502/20150214_22FC08FF5AFA324713390718AEDD23FA.jpg','145588','50','1423884858');
INSERT INTO jh_home_photo VALUES ('178','7','2','8','demo/homephoto/201502/20150214_09DC2646AD495F105619C68E639F94A4.jpg','647977','50','1423884856');
INSERT INTO jh_home_photo VALUES ('179','7','2','9','demo/homephoto/201502/20150214_447A176D6518AFE0A44A966CAD7F12F1.jpg','467505','50','1423884856');
INSERT INTO jh_home_photo VALUES ('180','9','1','1','demo/homephoto/201502/20150214_C81CA8AE5E6905AA6BDDC6AC8C6A6828.jpg','73325','50','1423884870');
INSERT INTO jh_home_photo VALUES ('181','9','1','2','demo/homephoto/201502/20150214_F5DB9F0DD4431B7839E9EE04D9AAA4AB.jpg','73468','50','1423884870');
INSERT INTO jh_home_photo VALUES ('182','7','2','10','demo/homephoto/201502/20150214_14EB83782BE9713A0A321D4DC9FA5BEC.jpg','370952','50','1423884856');
INSERT INTO jh_home_photo VALUES ('183','9','1','3','demo/homephoto/201502/20150214_56C7A7C808E2FA0758AE1401AE8AB797.jpg','71030','50','1423884870');
INSERT INTO jh_home_photo VALUES ('184','7','2','11','demo/homephoto/201502/20150214_A1FB0E7F74A3A6F7B242C86DA3F3B480.jpg','452838','50','1423884856');
INSERT INTO jh_home_photo VALUES ('185','9','1','4','demo/homephoto/201502/20150214_232F832161B2367C9ACD1D7229BA1469.jpg','208583','50','1423884870');
INSERT INTO jh_home_photo VALUES ('186','9','1','5','demo/homephoto/201502/20150214_78DD44AD6730B0E6C3E21ACFCA707541.jpg','199466','50','1423884870');
INSERT INTO jh_home_photo VALUES ('187','7','2','12','demo/homephoto/201502/20150214_B92E22F0C69E79F92084C11E969CAE72.jpg','356194','50','1423884856');
INSERT INTO jh_home_photo VALUES ('188','9','1','6','demo/homephoto/201502/20150214_D885C180E281E4ED5F2E81F3AE621722.jpg','318172','50','1423884870');
INSERT INTO jh_home_photo VALUES ('189','9','1','7','demo/homephoto/201502/20150214_EB7C8558638F92FD7F11AF8A576EFF01.jpg','273969','50','1423884870');
INSERT INTO jh_home_photo VALUES ('190','9','1','8','demo/homephoto/201502/20150214_95677122FD3BE9DE5E8C2762CAA45A3E.jpg','103416','50','1423884870');
INSERT INTO jh_home_photo VALUES ('191','10','1','1','demo/homephoto/201502/20150214_C99C98F199C3D223EABD6AF46A1BD8B2.jpg','228858','50','1423884873');
INSERT INTO jh_home_photo VALUES ('192','9','1','9','demo/homephoto/201502/20150214_00F8F58551A00CCF23987AC7EAAB0FCF.jpg','128680','50','1423884870');
INSERT INTO jh_home_photo VALUES ('193','10','1','2','demo/homephoto/201502/20150214_FEFAD5D902AF5A997403A015FF392333.jpg','240895','50','1423884873');
INSERT INTO jh_home_photo VALUES ('194','9','1','10','demo/homephoto/201502/20150214_BBFC9679C186937232FC6170815E1A0F.jpg','100539','50','1423884870');
INSERT INTO jh_home_photo VALUES ('195','10','1','3','demo/homephoto/201502/20150214_C24D34EC22B79DC7F78319854F4BC225.jpg','215626','50','1423884873');
INSERT INTO jh_home_photo VALUES ('196','10','1','4','demo/homephoto/201502/20150214_9A93A11772E042158C4FE68530AAF1F2.jpg','222806','50','1423884873');
INSERT INTO jh_home_photo VALUES ('197','9','1','11','demo/homephoto/201502/20150214_8B56A6BD293FB5144FC0CF548E7E0601.jpg','55445','50','1423884870');
INSERT INTO jh_home_photo VALUES ('198','10','1','5','demo/homephoto/201502/20150214_87554A0D8F56C29604F78904DF470C1B.jpg','239159','50','1423884873');
INSERT INTO jh_home_photo VALUES ('199','9','1','12','demo/homephoto/201502/20150214_2DB2BF35997F6BDCF9D430192C320DAD.jpg','56323','50','1423884870');
INSERT INTO jh_home_photo VALUES ('200','10','1','6','demo/homephoto/201502/20150214_6B0A2F138D288BA4DFD134A14226233A.jpg','202028','50','1423884873');
INSERT INTO jh_home_photo VALUES ('201','9','2','1','demo/homephoto/201502/20150214_461E15AC389ED43BD83D8F6FA9AC6124.jpg','134499','50','1423884870');
INSERT INTO jh_home_photo VALUES ('202','10','1','7','demo/homephoto/201502/20150214_C443480E4599AE1D9F07F16BCBBF58C6.jpg','240706','50','1423884873');
INSERT INTO jh_home_photo VALUES ('203','9','2','2','demo/homephoto/201502/20150214_2A5F2263FCC66326BD27CB8FEDC0C85B.jpg','257799','50','1423884870');
INSERT INTO jh_home_photo VALUES ('204','10','1','8','demo/homephoto/201502/20150214_4E1CCBCA07C1A56E7F6C2C83ABB4A58B.jpg','248161','50','1423884873');
INSERT INTO jh_home_photo VALUES ('205','9','2','3','demo/homephoto/201502/20150214_994AFF053BD95EE5E12B315D64B1512F.jpg','257199','50','1423884870');
INSERT INTO jh_home_photo VALUES ('206','9','2','4','demo/homephoto/201502/20150214_A29020F49DFE0DCBECAA8B5C359B459F.jpg','240681','50','1423884870');
INSERT INTO jh_home_photo VALUES ('207','10','1','9','demo/homephoto/201502/20150214_3CEE5D27F3A4F18D29732650982697D0.jpg','135487','50','1423884873');
INSERT INTO jh_home_photo VALUES ('208','9','2','5','demo/homephoto/201502/20150214_138613EB970D7229ECDD993CACF80C18.jpg','110741','50','1423884870');
INSERT INTO jh_home_photo VALUES ('209','10','1','10','demo/homephoto/201502/20150214_48F4A1FE5DABC69696DE426A03DD6905.jpg','137151','50','1423884873');
INSERT INTO jh_home_photo VALUES ('210','9','2','6','demo/homephoto/201502/20150214_64DEFCD98DF83C19F7E5FD1BC7A08DFE.jpg','132428','50','1423884870');
INSERT INTO jh_home_photo VALUES ('211','9','2','7','demo/homephoto/201502/20150214_E247706610DCF44571B36FF1FD71A688.jpg','89447','50','1423884870');
INSERT INTO jh_home_photo VALUES ('212','10','1','11','demo/homephoto/201502/20150214_1B308869F78A56A96D0640E05821331E.jpg','133241','50','1423884873');
INSERT INTO jh_home_photo VALUES ('213','9','2','8','demo/homephoto/201502/20150214_E016721A2E5CB445E1E1EFAB46980C29.jpg','117869','50','1423884870');
INSERT INTO jh_home_photo VALUES ('214','10','1','12','demo/homephoto/201502/20150214_52B36A765B83F71BF5C489FDB566EEC4.jpg','127884','50','1423884873');
INSERT INTO jh_home_photo VALUES ('215','9','2','9','demo/homephoto/201502/20150214_F44B1929FADD8BE4BC53851AF8C1B408.jpg','89533','50','1423884870');
INSERT INTO jh_home_photo VALUES ('216','10','2','1','demo/homephoto/201502/20150214_C150F5E5BFB145121955FDDB09B163FF.jpg','323262','50','1423884873');
INSERT INTO jh_home_photo VALUES ('217','9','2','10','demo/homephoto/201502/20150214_E6B6D3A9680B2717E81B6A3DE46F7E64.jpg','206487','50','1423884870');
INSERT INTO jh_home_photo VALUES ('218','10','2','2','demo/homephoto/201502/20150214_3719158D5F45437B460859D0D605DEFA.jpg','430435','50','1423884873');
INSERT INTO jh_home_photo VALUES ('219','10','2','3','demo/homephoto/201502/20150214_5DB24B9083B55A67DAA87E4B3A3404D2.jpg','473248','50','1423884873');
INSERT INTO jh_home_photo VALUES ('220','9','2','11','demo/homephoto/201502/20150214_B0276C2356C998EB85373370593E7EF9.jpg','190129','50','1423884870');
INSERT INTO jh_home_photo VALUES ('221','9','2','12','demo/homephoto/201502/20150214_33EBA38FDD052A486043E2A686778DFB.jpg','178127','50','1423884870');
INSERT INTO jh_home_photo VALUES ('222','10','2','4','demo/homephoto/201502/20150214_760FFC66C501BBD026A39CC2CF3C63B4.jpg','390996','50','1423884873');
INSERT INTO jh_home_photo VALUES ('223','10','2','5','demo/homephoto/201502/20150214_56BFACC0A8926510EA67410BB3DB0DDE.jpg','425850','50','1423884873');
INSERT INTO jh_home_photo VALUES ('224','11','1','1','demo/homephoto/201502/20150214_5D4018AAF33F8261D2D61E09098EFF60.jpg','116150','50','1423884882');
INSERT INTO jh_home_photo VALUES ('225','10','2','6','demo/homephoto/201502/20150214_FFEBAB63E8D2F0202A9047580A789EB8.jpg','513067','50','1423884873');
INSERT INTO jh_home_photo VALUES ('226','11','1','2','demo/homephoto/201502/20150214_20825EA68D797BE5FD54BD806B400E5C.jpg','142980','50','1423884882');
INSERT INTO jh_home_photo VALUES ('227','11','1','3','demo/homephoto/201502/20150214_C85897182E3C527C07794ECFB50559F5.jpg','102666','50','1423884882');
INSERT INTO jh_home_photo VALUES ('228','10','2','7','demo/homephoto/201502/20150214_DB8513AFA4C148B5396225C4555654E1.jpg','462613','50','1423884873');
INSERT INTO jh_home_photo VALUES ('229','11','1','4','demo/homephoto/201502/20150214_2EF71D2E43806AB605668EF39853B436.jpg','135345','50','1423884882');
INSERT INTO jh_home_photo VALUES ('230','10','2','8','demo/homephoto/201502/20150214_23FB3D842B5B614C1AE8D5761A226211.jpg','409874','50','1423884873');
INSERT INTO jh_home_photo VALUES ('231','11','1','5','demo/homephoto/201502/20150214_C6C57F8C04C3323BF5BE10B62EDA75C5.jpg','138394','50','1423884882');
INSERT INTO jh_home_photo VALUES ('232','10','2','9','demo/homephoto/201502/20150214_663DE2AB56255D9A3B4149AE59D54A0A.jpg','370334','50','1423884873');
INSERT INTO jh_home_photo VALUES ('233','10','2','10','demo/homephoto/201502/20150214_DAFEFBDF3D02FC34CC233F04B6E88EBE.jpg','421318','50','1423884873');
INSERT INTO jh_home_photo VALUES ('234','11','1','6','demo/homephoto/201502/20150214_461E4CDEA75EE96C3DA2D85C680ACF21.jpg','98692','50','1423884882');
INSERT INTO jh_home_photo VALUES ('235','10','2','11','demo/homephoto/201502/20150214_43E07F2B239D722FAE8DA33159619A76.jpg','455148','50','1423884873');
INSERT INTO jh_home_photo VALUES ('236','11','1','7','demo/homephoto/201502/20150214_5EB5E8C48E6B11D55E2CC77112F047F9.jpg','608312','50','1423884882');
INSERT INTO jh_home_photo VALUES ('237','10','2','12','demo/homephoto/201502/20150214_1208CD1594279D588E24AE6AB4A82C0E.jpg','468000','50','1423884873');
INSERT INTO jh_home_photo VALUES ('238','11','1','8','demo/homephoto/201502/20150214_66965C8BBA4543428A5CFCA10145D4FF.jpg','552946','50','1423884882');
INSERT INTO jh_home_photo VALUES ('239','11','1','9','demo/homephoto/201502/20150214_96B111D33DD7E775D0AB320A18C1476F.jpg','139473','50','1423884882');
INSERT INTO jh_home_photo VALUES ('240','12','1','1','demo/homephoto/201502/20150214_E04976E209375DC5868386119E08EC2C.jpg','173903','50','1423884886');
INSERT INTO jh_home_photo VALUES ('241','12','1','2','demo/homephoto/201502/20150214_AF5A7170D0FB48495A68FAF046FC472D.jpg','191763','50','1423884886');
INSERT INTO jh_home_photo VALUES ('242','11','1','10','demo/homephoto/201502/20150214_27689CFE8398B639E320F0B99F1F50E1.jpg','52414','50','1423884882');
INSERT INTO jh_home_photo VALUES ('243','12','1','3','demo/homephoto/201502/20150214_0B5083C7C331DEF9A385C3E5ADBDCC3E.jpg','91306','50','1423884886');
INSERT INTO jh_home_photo VALUES ('244','11','1','11','demo/homephoto/201502/20150214_6574D92B42834DC04A52CE7AB5B0A88E.jpg','60859','50','1423884882');
INSERT INTO jh_home_photo VALUES ('245','12','1','4','demo/homephoto/201502/20150214_6CF1DEA934BA317A9543D1F8F0967897.jpg','158023','50','1423884886');
INSERT INTO jh_home_photo VALUES ('246','11','1','12','demo/homephoto/201502/20150214_0FF4BAC5B87289517806764DB5040231.jpg','58129','50','1423884882');
INSERT INTO jh_home_photo VALUES ('247','11','2','1','demo/homephoto/201502/20150214_7C46F7A233EEAC49DAB513961C3221A9.jpg','134100','50','1423884882');
INSERT INTO jh_home_photo VALUES ('248','12','1','5','demo/homephoto/201502/20150214_872FFB271CBC1BE32279803A93F2D517.jpg','132234','50','1423884886');
INSERT INTO jh_home_photo VALUES ('249','12','1','6','demo/homephoto/201502/20150214_B24D67366697234D0BFCFB65DCBD93D0.jpg','129951','50','1423884886');
INSERT INTO jh_home_photo VALUES ('250','11','2','2','demo/homephoto/201502/20150214_7E2C654A8946B9B9C3A6C40E8126178F.jpg','101161','50','1423884882');
INSERT INTO jh_home_photo VALUES ('251','12','1','7','demo/homephoto/201502/20150214_9F5318715E60431AECCB54517BADFBF0.jpg','130618','50','1423884886');
INSERT INTO jh_home_photo VALUES ('252','11','2','3','demo/homephoto/201502/20150214_9DCAF54A74645D10EC49C09105AC024A.jpg','101005','50','1423884882');
INSERT INTO jh_home_photo VALUES ('253','12','1','8','demo/homephoto/201502/20150214_58EF6D79814A6C92096E0EBF27BAA876.jpg','130799','50','1423884886');
INSERT INTO jh_home_photo VALUES ('254','11','2','4','demo/homephoto/201502/20150214_199D1A575FE0EA13A1B0C8A0B0C664BD.jpg','103659','50','1423884882');
INSERT INTO jh_home_photo VALUES ('255','12','2','1','demo/homephoto/201502/20150214_13B99EB1F98A3326D917F7F6F43625D4.jpg','178843','50','1423884886');
INSERT INTO jh_home_photo VALUES ('256','11','2','5','demo/homephoto/201502/20150214_E543AEFD927C571E3AD2CD973CF0C882.jpg','98144','50','1423884882');
INSERT INTO jh_home_photo VALUES ('257','12','2','2','demo/homephoto/201502/20150214_7ABA486AAD012E37F91FB075217FB554.jpg','242873','50','1423884886');
INSERT INTO jh_home_photo VALUES ('258','11','2','6','demo/homephoto/201502/20150214_4C0BA14580E6C9287A9A1D356C0E304A.jpg','126000','50','1423884882');
INSERT INTO jh_home_photo VALUES ('259','12','2','3','demo/homephoto/201502/20150214_886E2386A861BFA75608DB650BD8CEDE.jpg','119851','50','1423884886');
INSERT INTO jh_home_photo VALUES ('260','11','2','7','demo/homephoto/201502/20150214_BC8D7AE6ACCC575428903EE23CB58AD8.jpg','160837','50','1423884882');
INSERT INTO jh_home_photo VALUES ('261','11','2','8','demo/homephoto/201502/20150214_B572544DB479FC0979616A221888DA9D.jpg','162704','50','1423884882');
INSERT INTO jh_home_photo VALUES ('262','12','2','4','demo/homephoto/201502/20150214_6697C019EE0B6EA154D8270C3410095D.jpg','191115','50','1423884886');
INSERT INTO jh_home_photo VALUES ('263','11','2','9','demo/homephoto/201502/20150214_E55E89FAEE461D6434403647C6D8AE64.jpg','124126','50','1423884882');
INSERT INTO jh_home_photo VALUES ('264','12','2','5','demo/homephoto/201502/20150214_4F299570F796525CF2BF74A9829F7FF4.jpg','177949','50','1423884886');
INSERT INTO jh_home_photo VALUES ('265','11','2','10','demo/homephoto/201502/20150214_ACC8492933910D0C977FE94050C56E7A.jpg','151253','50','1423884882');
INSERT INTO jh_home_photo VALUES ('266','12','2','6','demo/homephoto/201502/20150214_188D0A2D923FA52C5895DF0C2DEEE128.jpg','176896','50','1423884886');
INSERT INTO jh_home_photo VALUES ('267','11','2','11','demo/homephoto/201502/20150214_24FC1102E6296FD61DCBA159967E8C3E.jpg','200274','50','1423884882');
INSERT INTO jh_home_photo VALUES ('268','12','2','7','demo/homephoto/201502/20150214_8BB39A4FFFD7F0725B1A4B488C62E36F.jpg','119200','50','1423884886');
INSERT INTO jh_home_photo VALUES ('269','11','2','12','demo/homephoto/201502/20150214_029A8763FFD3B3A2E85C04C482F132D1.jpg','203536','50','1423884882');
INSERT INTO jh_home_photo VALUES ('270','12','2','8','demo/homephoto/201502/20150214_755C19BA2B2D7C2DEF6DF7602C4B74AB.jpg','102448','50','1423884886');
INSERT INTO jh_home_photo VALUES ('271','12','2','9','demo/homephoto/201502/20150214_2A796F52DE45B781392E964A893AE620.jpg','84413','50','1423884886');
INSERT INTO jh_home_photo VALUES ('272','12','2','10','demo/homephoto/201502/20150214_B8CFFC6484B0AFA69439A301766DD4CE.jpg','143191','50','1423884886');
INSERT INTO jh_home_photo VALUES ('273','13','1','1','demo/homephoto/201502/20150214_06428B25D3720C7DF8B5B1CB605FD0F5.jpg','108692','50','1423884895');
INSERT INTO jh_home_photo VALUES ('274','12','2','11','demo/homephoto/201502/20150214_3E4E0FDB04A21ECB2D89C4ECC64C8FBE.jpg','114367','50','1423884886');
INSERT INTO jh_home_photo VALUES ('275','13','1','2','demo/homephoto/201502/20150214_8A28B2AF2C0799C23CB4ED7E4B620128.jpg','118520','50','1423884895');
INSERT INTO jh_home_photo VALUES ('276','12','2','12','demo/homephoto/201502/20150214_724EE6AD9D9EDA2BCB6C4B69F655F568.jpg','201391','50','1423884886');
INSERT INTO jh_home_photo VALUES ('277','13','1','3','demo/homephoto/201502/20150214_9492E5341ABA32AE362731979B7740F6.jpg','116961','50','1423884895');
INSERT INTO jh_home_photo VALUES ('278','14','1','1','demo/homephoto/201502/20150214_D6090D7CDAD458505623316A77A7F314.jpg','159386','50','1423884897');
INSERT INTO jh_home_photo VALUES ('279','13','1','4','demo/homephoto/201502/20150214_9607BFE2C6A4ED63C406E012D65939FB.jpg','114968','50','1423884895');
INSERT INTO jh_home_photo VALUES ('280','14','1','2','demo/homephoto/201502/20150214_9929DBD0BE4DE1FF77780198A7095471.jpg','177709','50','1423884897');
INSERT INTO jh_home_photo VALUES ('281','13','1','5','demo/homephoto/201502/20150214_27C08945C2FB2AAF45ED7807480EE2A2.jpg','117013','50','1423884895');
INSERT INTO jh_home_photo VALUES ('282','14','1','3','demo/homephoto/201502/20150214_3A73FA71FF607789843BFA725C0E2B6F.jpg','221038','50','1423884897');
INSERT INTO jh_home_photo VALUES ('283','14','1','4','demo/homephoto/201502/20150214_2C9E653AD6601B5023D73AD7B12E716D.jpg','199996','50','1423884897');
INSERT INTO jh_home_photo VALUES ('284','13','1','6','demo/homephoto/201502/20150214_AFF4F4DC1D28B835EB3DBF37E4BC5CA5.jpg','119381','50','1423884895');
INSERT INTO jh_home_photo VALUES ('285','13','1','7','demo/homephoto/201502/20150214_9F653FFF63F552EAC3DBEB9F244D935A.jpg','115159','50','1423884895');
INSERT INTO jh_home_photo VALUES ('286','14','1','5','demo/homephoto/201502/20150214_41E7425A26CE66A17E70A778E9B3D9F5.jpg','104158','50','1423884897');
INSERT INTO jh_home_photo VALUES ('287','14','1','6','demo/homephoto/201502/20150214_BC87841B56C6E7E105B548BB21165F67.jpg','120663','50','1423884897');
INSERT INTO jh_home_photo VALUES ('288','13','1','8','demo/homephoto/201502/20150214_79EB07F164BDAE53AA0EE329322315A8.jpg','129889','50','1423884895');
INSERT INTO jh_home_photo VALUES ('289','14','1','7','demo/homephoto/201502/20150214_80926103514FA2C800AAB4EC9E91A6E7.jpg','111180','50','1423884897');
INSERT INTO jh_home_photo VALUES ('290','13','1','9','demo/homephoto/201502/20150214_D621B2E4DF4C135562FB94368D4DCF58.jpg','245995','50','1423884895');
INSERT INTO jh_home_photo VALUES ('291','14','1','8','demo/homephoto/201502/20150214_5F7387CCD22164CB74EBF3C944C6A648.jpg','113499','50','1423884897');
INSERT INTO jh_home_photo VALUES ('292','13','1','10','demo/homephoto/201502/20150214_00701658B8A8D37A2844162A019074AF.jpg','246793','50','1423884895');
INSERT INTO jh_home_photo VALUES ('293','14','1','9','demo/homephoto/201502/20150214_863911D5C386186AED3DD1DD9686B692.jpg','104352','50','1423884897');
INSERT INTO jh_home_photo VALUES ('294','14','1','10','demo/homephoto/201502/20150214_856E36CF7E71B85A1E12B427E08AE7E1.jpg','109052','50','1423884897');
INSERT INTO jh_home_photo VALUES ('295','13','1','11','demo/homephoto/201502/20150214_7CADCA578642AD33855E1B1EEBA224A6.jpg','241501','50','1423884895');
INSERT INTO jh_home_photo VALUES ('296','14','2','1','demo/homephoto/201502/20150214_02148C2741C47D1B036243513372ED73.jpg','467549','50','1423884897');
INSERT INTO jh_home_photo VALUES ('297','14','2','2','demo/homephoto/201502/20150214_152901F30F5B28970EB37B80FBA31795.jpg','416060','50','1423884897');
INSERT INTO jh_home_photo VALUES ('298','13','1','12','demo/homephoto/201502/20150214_DE96E98B4907E6A957C7B7D8DD6C4016.jpg','261340','50','1423884895');
INSERT INTO jh_home_photo VALUES ('299','13','2','1','demo/homephoto/201502/20150214_A3005510D4D6C701146DD365EBF060A1.jpg','349932','50','1423884895');
INSERT INTO jh_home_photo VALUES ('300','14','2','3','demo/homephoto/201502/20150214_3501F4D3123C17F28C8D16A426E7F223.jpg','637066','50','1423884897');
INSERT INTO jh_home_photo VALUES ('301','13','2','2','demo/homephoto/201502/20150214_1F0FD8453BA9E6B40E8AE88E1BFFC2FE.jpg','281373','50','1423884895');
INSERT INTO jh_home_photo VALUES ('302','14','2','4','demo/homephoto/201502/20150214_F1C8C149D2C116B8CFF0A05765059532.jpg','513108','50','1423884897');
INSERT INTO jh_home_photo VALUES ('303','13','2','3','demo/homephoto/201502/20150214_191B6CCE29367E14E8B9DFFB7BAFA521.jpg','324592','50','1423884895');
INSERT INTO jh_home_photo VALUES ('304','14','2','5','demo/homephoto/201502/20150214_36882A7A409C24B830F93328B7DA60EC.jpg','562016','50','1423884897');
INSERT INTO jh_home_photo VALUES ('305','13','2','4','demo/homephoto/201502/20150214_5A768FE2FE724A47BC2F74A7C468585D.jpg','416791','50','1423884895');
INSERT INTO jh_home_photo VALUES ('306','13','2','5','demo/homephoto/201502/20150214_D1E5BD69A59CAD035FA8F0113D549157.jpg','355059','50','1423884895');
INSERT INTO jh_home_photo VALUES ('307','13','2','6','demo/homephoto/201502/20150214_96A1DC3DA5F0E36BBD30683581BFF033.jpg','353760','50','1423884895');
INSERT INTO jh_home_photo VALUES ('308','13','2','7','demo/homephoto/201502/20150214_7CB9BB1242A47D8279D482966BD478AC.jpg','313322','50','1423884895');
INSERT INTO jh_home_photo VALUES ('309','13','2','8','demo/homephoto/201502/20150214_495D63CC96DBC43A9187A47A8D54E5F9.jpg','493905','50','1423884895');
INSERT INTO jh_home_photo VALUES ('310','14','2','6','demo/homephoto/201502/20150214_BF050A60496EBE0E03CCC056AD2C9574.jpg','462202','50','1423884897');
INSERT INTO jh_home_photo VALUES ('311','13','2','9','demo/homephoto/201502/20150214_B2E9D69EB70B9EE1835F3EABFDC37E29.jpg','545158','50','1423884895');
INSERT INTO jh_home_photo VALUES ('312','14','2','7','demo/homephoto/201502/20150214_5EAE0E1B6A4B7C6559FBFB7D7AEBE5DC.jpg','493509','50','1423884897');
INSERT INTO jh_home_photo VALUES ('313','14','2','8','demo/homephoto/201502/20150214_5E443DB06A27386895FDD51D5A4AEE31.jpg','646626','50','1423884897');
INSERT INTO jh_home_photo VALUES ('314','13','2','10','demo/homephoto/201502/20150214_C1657B49ABD7B9EEC1D88F038C4C6476.jpg','544782','50','1423884895');
INSERT INTO jh_home_photo VALUES ('315','14','2','9','demo/homephoto/201502/20150214_359AE0474A0B6BDAD087A5BF4DB22E57.jpg','366723','50','1423884897');
INSERT INTO jh_home_photo VALUES ('316','13','2','11','demo/homephoto/201502/20150214_EDC87F8D388299F1F50087F1670C6F93.jpg','484756','50','1423884895');
INSERT INTO jh_home_photo VALUES ('317','14','2','10','demo/homephoto/201502/20150214_152F0849521411B2B1C0678DCF942E5A.jpg','530256','50','1423884897');
INSERT INTO jh_home_photo VALUES ('318','13','2','12','demo/homephoto/201502/20150214_55C408CB68EEC74224CA58F9CD18B71F.jpg','431724','50','1423884895');
INSERT INTO jh_home_photo VALUES ('319','14','2','11','demo/homephoto/201502/20150214_ABBC0984DEF26B097A722ADF2A854BBA.jpg','556665','50','1423884897');
INSERT INTO jh_home_photo VALUES ('320','14','2','12','demo/homephoto/201502/20150214_E54918E4526768450AA0A18039297102.jpg','657305','50','1423884897');
INSERT INTO jh_home_photo VALUES ('321','15','1','1','demo/homephoto/201502/20150214_03F90A938A3BB0612533ED6E9DA1CE1D.jpg','125358','50','1423884910');
INSERT INTO jh_home_photo VALUES ('322','15','1','2','demo/homephoto/201502/20150214_8EC090CF4BE46520C4EA4F1D9ED7E33B.jpg','124848','50','1423884910');
INSERT INTO jh_home_photo VALUES ('323','15','1','3','demo/homephoto/201502/20150214_B3A4E9E33DEAEA67F903E07E04BCB55C.jpg','116176','50','1423884910');
INSERT INTO jh_home_photo VALUES ('324','16','1','1','demo/homephoto/201502/20150214_DB3CD5F4C6EDBD81D8828AF3C8B5AEF9.jpg','247310','50','1423884912');
INSERT INTO jh_home_photo VALUES ('325','15','1','4','demo/homephoto/201502/20150214_7094E5F64532B0CDFB389BF4BB292FEE.jpg','130189','50','1423884910');
INSERT INTO jh_home_photo VALUES ('326','15','2','1','demo/homephoto/201502/20150214_B706198B0FFAAB09F562BC6690F42EC4.jpg','223002','50','1423884910');
INSERT INTO jh_home_photo VALUES ('327','16','1','2','demo/homephoto/201502/20150214_77910B0349127BC8784BF02F8C73F317.jpg','297363','50','1423884912');
INSERT INTO jh_home_photo VALUES ('328','15','2','2','demo/homephoto/201502/20150214_C16AC24EB79BA5CBEB7CB797404C34EC.jpg','175727','50','1423884910');
INSERT INTO jh_home_photo VALUES ('329','15','2','3','demo/homephoto/201502/20150214_17414745A20BCB34745198B51D0C7963.jpg','336664','50','1423884910');
INSERT INTO jh_home_photo VALUES ('330','16','1','3','demo/homephoto/201502/20150214_EE0D4229F893B735CF372ACFD0730F82.jpg','254973','50','1423884912');
INSERT INTO jh_home_photo VALUES ('331','15','2','4','demo/homephoto/201502/20150214_70733E03F6CFBD35E3A2C2407A481D7E.jpg','314657','50','1423884910');
INSERT INTO jh_home_photo VALUES ('332','16','1','4','demo/homephoto/201502/20150214_DCF0F36B1243CD07F66FB6B16F5E09C5.jpg','217189','50','1423884912');
INSERT INTO jh_home_photo VALUES ('333','15','2','5','demo/homephoto/201502/20150214_4434F93BF6BE29EBD3359EE66E4C3EC2.jpg','355437','50','1423884910');
INSERT INTO jh_home_photo VALUES ('334','16','1','5','demo/homephoto/201502/20150214_64F2F3460AC4EAE2D10DE288A806AD6D.jpg','154518','50','1423884912');
INSERT INTO jh_home_photo VALUES ('335','15','2','6','demo/homephoto/201502/20150214_A91633DFAA3FC2CAAA1413E3FBE0341B.jpg','200569','50','1423884910');
INSERT INTO jh_home_photo VALUES ('336','15','2','7','demo/homephoto/201502/20150214_8443FF24BD9D6EBD6EDE18E60B9FD36E.jpg','273354','50','1423884910');
INSERT INTO jh_home_photo VALUES ('337','16','1','6','demo/homephoto/201502/20150214_264ACED108B1E5AC79E73E5A02FEFC65.jpg','145438','50','1423884912');
INSERT INTO jh_home_photo VALUES ('338','15','2','8','demo/homephoto/201502/20150214_A02D2789AC45DA1E086C3B580A0A2773.jpg','330440','50','1423884910');
INSERT INTO jh_home_photo VALUES ('339','16','1','7','demo/homephoto/201502/20150214_1C99502CB4E7D2C1D289DA1D1D71CCC8.jpg','154525','50','1423884912');
INSERT INTO jh_home_photo VALUES ('340','15','2','9','demo/homephoto/201502/20150214_344694BD279C852A17C967C5B4DB3059.jpg','202676','50','1423884910');
INSERT INTO jh_home_photo VALUES ('341','16','1','8','demo/homephoto/201502/20150214_5CA017979D0386F699DF0FD0A4DBFECC.jpg','142970','50','1423884912');
INSERT INTO jh_home_photo VALUES ('342','15','2','10','demo/homephoto/201502/20150214_93877D30771CD59A33308E609E30DCFA.jpg','232640','50','1423884910');
INSERT INTO jh_home_photo VALUES ('343','16','1','9','demo/homephoto/201502/20150214_E1198B9E4E77AA65C649C2D24F82EB7B.jpg','115617','50','1423884912');
INSERT INTO jh_home_photo VALUES ('344','16','1','10','demo/homephoto/201502/20150214_1A716EFBB3C3E57EFBA4801871DB26B9.jpg','105173','50','1423884912');
INSERT INTO jh_home_photo VALUES ('345','15','2','11','demo/homephoto/201502/20150214_0544DA29C522BC8CD5B22374AAC8F055.jpg','245407','50','1423884910');
INSERT INTO jh_home_photo VALUES ('346','16','1','11','demo/homephoto/201502/20150214_414C0FBE35C1B65F647FD3DEC0542B7E.jpg','153110','50','1423884912');
INSERT INTO jh_home_photo VALUES ('347','15','2','12','demo/homephoto/201502/20150214_4751C0E9E3ABBAFA3AE9E0B80C4DF1D9.jpg','244802','50','1423884910');
INSERT INTO jh_home_photo VALUES ('348','16','1','12','demo/homephoto/201502/20150214_8B8EB6ABA640BF00BD854B6892245D07.jpg','142885','50','1423884912');
INSERT INTO jh_home_photo VALUES ('349','16','2','1','demo/homephoto/201502/20150214_0666703E800A6FA384AC12021A95E2B5.jpg','196736','50','1423884912');
INSERT INTO jh_home_photo VALUES ('350','17','1','1','demo/homephoto/201502/20150214_38C856236023EE26191AEB13FC3A8CD7.jpg','172298','50','1423884917');
INSERT INTO jh_home_photo VALUES ('351','16','2','2','demo/homephoto/201502/20150214_6854D2272C1A4D6780504DBF996060CC.jpg','175854','50','1423884912');
INSERT INTO jh_home_photo VALUES ('352','17','1','2','demo/homephoto/201502/20150214_B1B7A60EBBABC560250F29F2DB432C8E.jpg','185504','50','1423884917');
INSERT INTO jh_home_photo VALUES ('353','16','2','3','demo/homephoto/201502/20150214_4827D905434076EA57867E9C4B6E8913.jpg','167040','50','1423884912');
INSERT INTO jh_home_photo VALUES ('354','17','1','3','demo/homephoto/201502/20150214_F48FFEA5C4E67BBABC0BE5632DEFCE1D.jpg','167170','50','1423884917');
INSERT INTO jh_home_photo VALUES ('355','16','2','4','demo/homephoto/201502/20150214_49A5F678BC243437A8093038558ED841.jpg','76409','50','1423884912');
INSERT INTO jh_home_photo VALUES ('356','17','1','4','demo/homephoto/201502/20150214_A9550E2832D5A98CEBE4CC06FDC3A716.jpg','168543','50','1423884917');
INSERT INTO jh_home_photo VALUES ('357','16','2','5','demo/homephoto/201502/20150214_805DDFFE7304A8F9D8B66E03352E741E.jpg','117707','50','1423884912');
INSERT INTO jh_home_photo VALUES ('358','17','1','5','demo/homephoto/201502/20150214_22583BFF8A0C0A8E3779DF35AB005CEB.jpg','118726','50','1423884917');
INSERT INTO jh_home_photo VALUES ('359','16','2','6','demo/homephoto/201502/20150214_368940E6D014F831AEB1CA0B18D6C538.jpg','102862','50','1423884912');
INSERT INTO jh_home_photo VALUES ('360','16','2','7','demo/homephoto/201502/20150214_240EFB8F26F4DA7E0F5F2178FA28A43C.jpg','122188','50','1423884912');
INSERT INTO jh_home_photo VALUES ('361','17','1','6','demo/homephoto/201502/20150214_8E16480C663DDD421E4EE40F72C5112A.jpg','116070','50','1423884917');
INSERT INTO jh_home_photo VALUES ('362','16','2','8','demo/homephoto/201502/20150214_47DDE0DF1FE456229CFA9A2BE3D26684.jpg','85556','50','1423884912');
INSERT INTO jh_home_photo VALUES ('363','17','1','7','demo/homephoto/201502/20150214_D03F12EFD50B1E6138CFDE01CDF5654D.jpg','113912','50','1423884917');
INSERT INTO jh_home_photo VALUES ('364','16','2','9','demo/homephoto/201502/20150214_1637DAE10E3751C2351F04113D2E7D91.jpg','131968','50','1423884912');
INSERT INTO jh_home_photo VALUES ('365','17','1','8','demo/homephoto/201502/20150214_AAB6120755FFFF26196D03492F6D08F0.jpg','113279','50','1423884917');
INSERT INTO jh_home_photo VALUES ('366','17','1','9','demo/homephoto/201502/20150214_5086B36D0E9243987A7949B4340E3F46.jpg','104131','50','1423884917');
INSERT INTO jh_home_photo VALUES ('367','16','2','10','demo/homephoto/201502/20150214_61F463E87EA29493C217A580CC50E9B1.jpg','95888','50','1423884912');
INSERT INTO jh_home_photo VALUES ('368','16','2','11','demo/homephoto/201502/20150214_2B0FB2B8F0CAC0FDE00C0A3A6196F7A2.jpg','144503','50','1423884912');
INSERT INTO jh_home_photo VALUES ('369','17','1','10','demo/homephoto/201502/20150214_C797B30472C337AD00E8377FE79B9021.jpg','96981','50','1423884917');
INSERT INTO jh_home_photo VALUES ('370','16','2','12','demo/homephoto/201502/20150214_5E5FE3D7C947967739A289906F91B7EA.jpg','139001','50','1423884912');
INSERT INTO jh_home_photo VALUES ('371','17','1','11','demo/homephoto/201502/20150214_418235469E239947459987E29F9FB550.jpg','104778','50','1423884917');
INSERT INTO jh_home_photo VALUES ('372','17','1','12','demo/homephoto/201502/20150214_9359824F0E3516502C62AAC08EF8B738.jpg','120433','50','1423884917');
INSERT INTO jh_home_photo VALUES ('373','18','1','1','demo/homephoto/201502/20150214_150C09CC193E0961A21B9E3C26ECBEA7.jpg','215784','50','1423884924');
INSERT INTO jh_home_photo VALUES ('374','17','2','1','demo/homephoto/201502/20150214_B74238582CB573B7894F33767DF03F97.jpg','468830','50','1423884917');
INSERT INTO jh_home_photo VALUES ('375','18','1','2','demo/homephoto/201502/20150214_16968ADC2B7768AFBBC3B4A85792BFC4.jpg','235022','50','1423884924');
INSERT INTO jh_home_photo VALUES ('376','17','2','2','demo/homephoto/201502/20150214_D659C35BD75901FF0D9346CA0081F391.jpg','405157','50','1423884917');
INSERT INTO jh_home_photo VALUES ('377','18','1','3','demo/homephoto/201502/20150214_8EDEE1E6233560D01A99D1E308E02230.jpg','202853','50','1423884924');
INSERT INTO jh_home_photo VALUES ('378','18','1','4','demo/homephoto/201502/20150214_8A29A49F24F7C79B66FCF80C9C009A3E.jpg','216625','50','1423884924');
INSERT INTO jh_home_photo VALUES ('379','17','2','3','demo/homephoto/201502/20150214_D5FA8BBB73B2EFEA28CA89BFB8D9C4B9.jpg','403945','50','1423884917');
INSERT INTO jh_home_photo VALUES ('380','18','1','5','demo/homephoto/201502/20150214_33BF51DE10648457DBC9BEBBEA39B85A.jpg','99160','50','1423884924');
INSERT INTO jh_home_photo VALUES ('381','18','1','6','demo/homephoto/201502/20150214_2CB4A501DE1A9A5A9AE3F7B2D977D7B6.jpg','91520','50','1423884924');
INSERT INTO jh_home_photo VALUES ('382','17','2','4','demo/homephoto/201502/20150214_175A7F68C1D11D146CE0620529F7D7FE.jpg','352540','50','1423884917');
INSERT INTO jh_home_photo VALUES ('383','18','1','7','demo/homephoto/201502/20150214_FEBFACBFFB8E98C500BE4E37B3FD8FC7.jpg','114862','50','1423884924');
INSERT INTO jh_home_photo VALUES ('384','17','2','5','demo/homephoto/201502/20150214_147370979ED5EEC5C0A3D4318A3532A3.jpg','496150','50','1423884917');
INSERT INTO jh_home_photo VALUES ('385','18','1','8','demo/homephoto/201502/20150214_5AA3DFEC317DD03D8529050462095FB1.jpg','100251','50','1423884924');
INSERT INTO jh_home_photo VALUES ('386','18','1','9','demo/homephoto/201502/20150214_D3481DDACA2019B81C28F5E2F5414E43.jpg','106902','50','1423884924');
INSERT INTO jh_home_photo VALUES ('387','17','2','6','demo/homephoto/201502/20150214_2849C0863900D2CBE11138C723993B6C.jpg','600682','50','1423884917');
INSERT INTO jh_home_photo VALUES ('388','18','1','10','demo/homephoto/201502/20150214_A35E3BD66CE582846C7FF012F6B8930C.jpg','104340','50','1423884924');
INSERT INTO jh_home_photo VALUES ('389','18','1','11','demo/homephoto/201502/20150214_B5AA4461D2438AD8BF6F4AE9593BC028.jpg','95688','50','1423884924');
INSERT INTO jh_home_photo VALUES ('390','17','2','7','demo/homephoto/201502/20150214_E71181C392C23D2C2C209E7F71992973.jpg','595657','50','1423884917');
INSERT INTO jh_home_photo VALUES ('391','17','2','8','demo/homephoto/201502/20150214_F602C42473CD842FCF8F747ABAE232D8.jpg','596206','50','1423884917');
INSERT INTO jh_home_photo VALUES ('392','18','1','12','demo/homephoto/201502/20150214_9AD340C3FD88E8E522A7BFFDBB7AA94F.jpg','85047','50','1423884924');
INSERT INTO jh_home_photo VALUES ('393','18','2','1','demo/homephoto/201502/20150214_D2EC5E9A580E2D305DF718D6B8B7D4CB.jpg','116113','50','1423884924');
INSERT INTO jh_home_photo VALUES ('394','17','2','9','demo/homephoto/201502/20150214_C13C4DE7E6455E96491A7769BB3BCD8B.jpg','655896','50','1423884917');
INSERT INTO jh_home_photo VALUES ('395','18','2','2','demo/homephoto/201502/20150214_542C5A19777E2EA3AEF47CBFD75DC6D6.jpg','92925','50','1423884924');
INSERT INTO jh_home_photo VALUES ('396','18','2','3','demo/homephoto/201502/20150214_9BA83FF5F51CA5BE7C93815157FE8F6D.jpg','101238','50','1423884924');
INSERT INTO jh_home_photo VALUES ('397','17','2','10','demo/homephoto/201502/20150214_87F59045E48B355E97C76445343270BC.jpg','578359','50','1423884917');
INSERT INTO jh_home_photo VALUES ('398','18','2','4','demo/homephoto/201502/20150214_78112EC67692E28B16938AF7F3B86A2C.jpg','90491','50','1423884924');
INSERT INTO jh_home_photo VALUES ('399','18','2','5','demo/homephoto/201502/20150214_FD51EA392C879625AD31E2CECD80E9D4.jpg','92696','50','1423884924');
INSERT INTO jh_home_photo VALUES ('400','17','2','11','demo/homephoto/201502/20150214_1DF3ACCD593207AC9D7C4BFEF840E32D.jpg','337411','50','1423884917');
INSERT INTO jh_home_photo VALUES ('401','18','2','6','demo/homephoto/201502/20150214_1AA25E2206338657ABC41B333287E053.jpg','140901','50','1423884924');
INSERT INTO jh_home_photo VALUES ('402','18','2','7','demo/homephoto/201502/20150214_4DF329F5E64F12BABF789C2A8864BB2A.jpg','137350','50','1423884924');
INSERT INTO jh_home_photo VALUES ('403','17','2','12','demo/homephoto/201502/20150214_9B8EB914DFC349548F08FC38CD987A9B.jpg','493099','50','1423884917');
INSERT INTO jh_home_photo VALUES ('404','18','2','8','demo/homephoto/201502/20150214_45E908CE0B05F3C8A77EBD6BF9F70EA1.jpg','186916','50','1423884924');
INSERT INTO jh_home_photo VALUES ('405','18','2','9','demo/homephoto/201502/20150214_5D0356131E52B5FDE3BE34AB1CDF9BF0.jpg','104419','50','1423884924');
INSERT INTO jh_home_photo VALUES ('406','18','2','10','demo/homephoto/201502/20150214_9A11A353C0DAC8E5852086A060926367.jpg','167107','50','1423884924');
INSERT INTO jh_home_photo VALUES ('407','19','1','1','demo/homephoto/201502/20150214_82F229BB620C9A7C8910F2AE359695BC.jpg','66314','50','1423884935');
INSERT INTO jh_home_photo VALUES ('408','18','2','11','demo/homephoto/201502/20150214_F1D11EBD2A436A7D97C9DA919448EBBD.jpg','147161','50','1423884924');
INSERT INTO jh_home_photo VALUES ('409','19','1','2','demo/homephoto/201502/20150214_58828B20DA2612330AF6505809AB8FE7.jpg','69008','50','1423884935');
INSERT INTO jh_home_photo VALUES ('410','19','1','3','demo/homephoto/201502/20150214_66CF333BA43C2FA0E6DCEC32634BF43A.jpg','73842','50','1423884935');
INSERT INTO jh_home_photo VALUES ('411','18','2','12','demo/homephoto/201502/20150214_896A87F63DA1908C2E42A0D52BA2E614.jpg','140352','50','1423884924');
INSERT INTO jh_home_photo VALUES ('412','19','1','4','demo/homephoto/201502/20150214_681176D390EFCE0F593C6FB3DBDE0CE1.jpg','68498','50','1423884935');
INSERT INTO jh_home_photo VALUES ('413','19','1','5','demo/homephoto/201502/20150214_E555ED48463FEC74E3836F1E10EA4578.jpg','73360','50','1423884935');
INSERT INTO jh_home_photo VALUES ('414','20','1','1','demo/homephoto/201502/20150214_6476DF62498D25B020C4DD4490992938.jpg','52576','50','1423884937');
INSERT INTO jh_home_photo VALUES ('415','19','1','6','demo/homephoto/201502/20150214_E8504F31D116F3A81512723C55088682.jpg','82777','50','1423884935');
INSERT INTO jh_home_photo VALUES ('416','20','1','2','demo/homephoto/201502/20150214_D182860CB0E248DF1CE8A3420D81C20A.jpg','68668','50','1423884937');
INSERT INTO jh_home_photo VALUES ('417','19','1','7','demo/homephoto/201502/20150214_BC5814078D0DDDD6C5A101DF5701D624.jpg','284288','50','1423884935');
INSERT INTO jh_home_photo VALUES ('418','19','1','8','demo/homephoto/201502/20150214_142CA28D16C5EFD03CF2C9D96EBDE1F3.jpg','330445','50','1423884935');
INSERT INTO jh_home_photo VALUES ('419','20','1','3','demo/homephoto/201502/20150214_BE013736C34A40EDADECD47858717DA4.jpg','76129','50','1423884937');
INSERT INTO jh_home_photo VALUES ('420','19','1','9','demo/homephoto/201502/20150214_46FE0DB7AFED4816D2F18C133BC40372.jpg','253618','50','1423884935');
INSERT INTO jh_home_photo VALUES ('421','19','1','10','demo/homephoto/201502/20150214_5DBF76E8946C396D8E860E3D9E1AB9BF.jpg','277674','50','1423884935');
INSERT INTO jh_home_photo VALUES ('422','20','1','4','demo/homephoto/201502/20150214_92FE57FC8C16CB252D2625D21004343E.jpg','85270','50','1423884937');
INSERT INTO jh_home_photo VALUES ('423','19','1','11','demo/homephoto/201502/20150214_E4A525A32B8FEA7A66F6A8CA1C16A129.jpg','251879','50','1423884935');
INSERT INTO jh_home_photo VALUES ('424','20','1','5','demo/homephoto/201502/20150214_7389E3E6A43946B7AF055D40FE5AA6A1.jpg','71964','50','1423884937');
INSERT INTO jh_home_photo VALUES ('425','19','1','12','demo/homephoto/201502/20150214_12DCA3730D7B333D101FF2964FDF1908.jpg','281243','50','1423884935');
INSERT INTO jh_home_photo VALUES ('426','20','1','6','demo/homephoto/201502/20150214_3119EC929BD74EE1358A1A65B4CF7451.jpg','67873','50','1423884937');
INSERT INTO jh_home_photo VALUES ('427','19','2','1','demo/homephoto/201502/20150214_0A75B2A226D511658C06F892361FB29C.jpg','142898','50','1423884935');
INSERT INTO jh_home_photo VALUES ('428','20','1','7','demo/homephoto/201502/20150214_DDD39807E9314C88E5C4DF6D0AAC3C7D.jpg','52092','50','1423884937');
INSERT INTO jh_home_photo VALUES ('429','19','2','2','demo/homephoto/201502/20150214_7AE1605F511F27273D0664A47ABCEC3E.jpg','121980','50','1423884935');
INSERT INTO jh_home_photo VALUES ('430','20','1','8','demo/homephoto/201502/20150214_8A54F7260ADEC5EBDFE2FDB0BACE89CD.jpg','69431','50','1423884937');
INSERT INTO jh_home_photo VALUES ('431','20','1','9','demo/homephoto/201502/20150214_3EC7D5A7312B15C797FA5546B3DF9358.jpg','57838','50','1423884937');
INSERT INTO jh_home_photo VALUES ('432','19','2','3','demo/homephoto/201502/20150214_BE2F4CEC8F4ACEE55189F04351C3927C.jpg','152537','50','1423884935');
INSERT INTO jh_home_photo VALUES ('433','20','1','10','demo/homephoto/201502/20150214_F803125050EF575507994A61EB5DEC12.jpg','51774','50','1423884937');
INSERT INTO jh_home_photo VALUES ('434','19','2','4','demo/homephoto/201502/20150214_6A248F0A383322F51CF80904E9D57C47.jpg','146706','50','1423884935');
INSERT INTO jh_home_photo VALUES ('435','20','1','11','demo/homephoto/201502/20150214_34063D34F1B56B1A00F777FE0707114F.jpg','57666','50','1423884937');
INSERT INTO jh_home_photo VALUES ('436','19','2','5','demo/homephoto/201502/20150214_0261AF3344C1ADD641D959FD5CE8A7F2.jpg','151453','50','1423884935');
INSERT INTO jh_home_photo VALUES ('437','20','1','12','demo/homephoto/201502/20150214_43323FA8C1340724369183E5B83DA43D.jpg','51895','50','1423884937');
INSERT INTO jh_home_photo VALUES ('438','19','2','6','demo/homephoto/201502/20150214_B2E9C87DB15D0BF3669F274603A59744.jpg','128046','50','1423884935');
INSERT INTO jh_home_photo VALUES ('439','20','2','1','demo/homephoto/201502/20150214_B1EE17E83AB44C14AEFD30E1060BAAC9.jpg','173428','50','1423884937');
INSERT INTO jh_home_photo VALUES ('440','19','2','7','demo/homephoto/201502/20150214_F85A6BCD54B8D4A5CD5A5AFBEB8C5453.jpg','151003','50','1423884935');
INSERT INTO jh_home_photo VALUES ('441','20','2','2','demo/homephoto/201502/20150214_A9F2D1827471523B928C487D21887C6A.jpg','151984','50','1423884937');
INSERT INTO jh_home_photo VALUES ('442','19','2','8','demo/homephoto/201502/20150214_E1E3F1BD7421162C2D6FF7CC18A219E5.jpg','116149','50','1423884935');
INSERT INTO jh_home_photo VALUES ('443','20','2','3','demo/homephoto/201502/20150214_E6A75EE8A99F1EE87DCE2E7988926809.jpg','169877','50','1423884937');
INSERT INTO jh_home_photo VALUES ('444','19','2','9','demo/homephoto/201502/20150214_8F889424EF0B506CBB574A76592256B2.jpg','131149','50','1423884935');
INSERT INTO jh_home_photo VALUES ('445','20','2','4','demo/homephoto/201502/20150214_3C1A8DF826F26E5C94C130C578A6FAD5.jpg','166683','50','1423884937');
INSERT INTO jh_home_photo VALUES ('446','19','2','10','demo/homephoto/201502/20150214_97F4D54C341669BE5C832E8A00A2246D.jpg','136099','50','1423884935');
INSERT INTO jh_home_photo VALUES ('447','20','2','5','demo/homephoto/201502/20150214_FE1580E63CC1CC799AFABFB7DA4690A3.jpg','209383','50','1423884937');
INSERT INTO jh_home_photo VALUES ('448','19','2','11','demo/homephoto/201502/20150214_269B2CE68CE32908E084F7DC062A16B2.jpg','200358','50','1423884935');
INSERT INTO jh_home_photo VALUES ('449','20','2','6','demo/homephoto/201502/20150214_1B2749C754A07947BD2B7CAE3BFB9804.jpg','171579','50','1423884937');
INSERT INTO jh_home_photo VALUES ('450','19','2','12','demo/homephoto/201502/20150214_09896F4FE9FEDB0FEDEBCFBFD286280C.jpg','225182','50','1423884935');
INSERT INTO jh_home_photo VALUES ('451','20','2','7','demo/homephoto/201502/20150214_B6721B488FF7B931876FF0774B6FB4CF.jpg','164256','50','1423884937');
INSERT INTO jh_home_photo VALUES ('452','20','2','8','demo/homephoto/201502/20150214_3944B918D67A046AFB828BAC3CB6BE31.jpg','157881','50','1423884937');
INSERT INTO jh_home_photo VALUES ('453','20','2','9','demo/homephoto/201502/20150214_1E6814FA5A564BEADF608CFEDEFCACEB.jpg','157917','50','1423884937');
INSERT INTO jh_home_photo VALUES ('454','20','2','10','demo/homephoto/201502/20150214_F469E37FC5E0925BE40D67B56B3DC027.jpg','429124','50','1423884937');
INSERT INTO jh_home_photo VALUES ('455','20','2','11','demo/homephoto/201502/20150214_73D4BE69FC69493036E9A9DB0677FE41.jpg','429124','50','1423884937');
INSERT INTO jh_home_photo VALUES ('456','20','2','12','demo/homephoto/201502/20150214_9B1EF9B8FC5E927C4899088B303AE90F.jpg','178505','50','1423884937');
DROP TABLE IF EXISTS jh_home_site;
CREATE TABLE `jh_home_site` (
  `site_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `company_id` mediumint(8) DEFAULT '0',
  `case_id` mediumint(8) DEFAULT '0',
  `zxpm_id` mediumint(8) DEFAULT NULL,
  `thumb` varchar(150) DEFAULT NULL,
  `title` varchar(80) DEFAULT '',
  `home_name` varchar(150) DEFAULT '',
  `home_id` mediumint(8) DEFAULT '0',
  `house_mj` smallint(6) DEFAULT '0',
  `price` varchar(10) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `addr` varchar(255) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  `lng` varchar(15) DEFAULT '',
  `lat` varchar(15) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 AUTO_INCREMENT=59;

INSERT INTO jh_home_site VALUES ('1','7','3','52','15','14','','demo/photo/201502/20150215_4CE8F3283BEDF30F3813FB9AEF9DA850.jpg','保利香槟国际工地','保利香槟国际','18','95','120000','2','','','127.0.0.1','1423967295','117.206289','31.817794','1');
INSERT INTO jh_home_site VALUES ('2','7','3','53','1','26','','demo/photo/201502/20150215_7730E106F3B6569D2B90E9CCA9F9B0FE.jpg','北城世纪城王先生的新家','北城世纪城','20','103','98650','2','','','127.0.0.1','1423968017','117.248931','32.007639','1');
INSERT INTO jh_home_site VALUES ('3','7','3','54','39','22','','demo/photo/201502/20150215_2658D3958191434973A99E21309C7D81.jpg','万科蓝山李小姐的家','万科蓝山','8','120','138000','4','','','127.0.0.1','1423968699','117.309916','31.745811','1');
INSERT INTO jh_home_site VALUES ('4','7','3','55','28','20','','demo/photo/201502/20150215_5F8BA29B259395040886474FA2DDB287.jpg','华润熙云府的样板工地','华润熙云府','15','114','95700','1','','','127.0.0.1','1423969008','117.309998','31.928622','1');
INSERT INTO jh_home_site VALUES ('5','7','3','56','45','21','','demo/photo/201502/20150215_0B4A5F75209A9A535B7B60BF54717D67.jpg','万科森林公园的工地','万科森林公园','3','85','73500','7','','','127.0.0.1','1423969556','117.240569','31.901301','1');
DROP TABLE IF EXISTS jh_home_site_item;
CREATE TABLE `jh_home_site_item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` mediumint(8) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `content` mediumtext,
  `photo_ids` varchar(255) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `__INDEX` (`site_id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 AUTO_INCREMENT=54;

INSERT INTO jh_home_site_item VALUES ('1','1','1','签订合同','<img src=\"./attachs/demo/photo/201502/20150215_F3C5B35AB50849473D370CAE18BD68CA.jpg?PID15\" alt=\"\" /><img src=\"./attachs/demo/photo/201502/20150215_76352C6E5DCEC506EAD5F932321A0AAA.jpg?PID16\" alt=\"\" /><img src=\"./attachs/demo/photo/201502/20150215_8E62307B36DE756822CD6C0DBC26851D.jpg?PID17\" alt=\"\" />','','127.0.0.1','1423966684');
INSERT INTO jh_home_site_item VALUES ('2','1','2','水电改造','<img src=\"./attachs/demo/photo/201502/20150215_2BF0FAD163E891D8D2BC513DF4E1D20F.jpg?PID18\" alt=\"\" /><img src=\"./attachs/demo/photo/201502/20150215_6E936C4BBDFC52E089B9F93F529D6EF2.jpg?PID19\" alt=\"\" /><img src=\"./attachs/demo/photo/201502/20150215_0F2D5CABD7C83B04844F1D2BB6A9C462.jpg?PID20\" alt=\"\" /><img src=\"./attachs/demo/photo/201502/20150215_5836E19E67627CB5612AB578718CE73C.jpg?PID21\" alt=\"\" />','','127.0.0.1','1423967295');
INSERT INTO jh_home_site_item VALUES ('3','2','1','合同签订','今天和王先生签订了合同，准备开工了。','','127.0.0.1','1423967884');
INSERT INTO jh_home_site_item VALUES ('4','2','2','水电改造','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_79C9112EBF9DEE700C83760C86C639D0.jpg?PID23\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_CDA38E2C0D8954CDF558C2ECB7BAA44B.jpg?PID24\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_438FF0D6CAB63B773A28C7627189C10F.jpg?PID25\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_9BCC308E2BCDF78DDFA2B8B37A3AF913.jpg?PID26\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_FF32F3089725FA760B9448200539D6B6.jpg?PID27\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','','127.0.0.1','1423968017');
INSERT INTO jh_home_site_item VALUES ('5','3','1','签订合同','<img src=\"./attachs/demo/photo/201502/20150215_7A004BF74F5FACC3C40AB4BAD50CD8D3.jpg?PID29\" alt=\"\" />&nbsp;&nbsp;<img src=\"./attachs/demo/photo/201502/20150215_BC759F7E2651D773CEFA3E9D3AE21BA5.jpg?PID30\" alt=\"\" />','','127.0.0.1','1423968486');
INSERT INTO jh_home_site_item VALUES ('6','3','2','水电改造','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_4083750E3162E908D09ABF6257DA76CD.jpg?PID31\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_2CF90A3383A7E57D444867FBE8D257DF.jpg?PID32\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_67931123E3CF1909D831E3DFBFD7348B.jpg?PID33\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_A5FAD1563B506C1175CECCB5BF245241.jpg?PID34\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_8923EE39D2353D08EB0F7B17FE277C26.jpg?PID35\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_18BD1E21ADFD10213270A3DCB3EAC525.jpg?PID36\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','','127.0.0.1','1423968598');
INSERT INTO jh_home_site_item VALUES ('7','3','4','木工阶段','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_7BA3E0654EC69F0D03F736910271ECF6.jpg?PID37\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_B43E151E66505D80B931DF36C59F6818.jpg?PID38\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_A5C37FF5F98FE256E69B784A653EDBEA.jpg?PID39\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_9BF96CB8EEE56A77B810EADF6C5CA100.jpg?PID40\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_97CAAE2587637CE3A1D4EB8794871F74.jpg?PID41\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','','127.0.0.1','1423968699');
INSERT INTO jh_home_site_item VALUES ('8','4','1','签订装修保','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_AEBA972A0659242D99206C2A73EDBFA1.jpg?PID43\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_C1B2D4B0C804358775AC85A941547337.jpg?PID44\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_157A16AB4C8ED14D8212D1FF51FD3F70.jpg?PID45\" alt=\"\" />\r\n</p>','','127.0.0.1','1423969008');
INSERT INTO jh_home_site_item VALUES ('9','5','1','签订装修保','<img src=\"./attachs/demo/photo/201502/20150215_F34B6F79EAC6F753A4692025E5324AE3.jpg?PID47\" alt=\"\" />','','127.0.0.1','1423969414');
INSERT INTO jh_home_site_item VALUES ('10','5','2','水电验收','<img src=\"./attachs/demo/photo/201502/20150215_C60506948967CCF409311680764A1F8B.jpg?PID48\" alt=\"\" />','','127.0.0.1','1423969443');
INSERT INTO jh_home_site_item VALUES ('11','5','3','泥瓦验收','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_83603FEA132D06604F0697659B0DC382.png?PID49\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_1A974E68E911C1BAE004E3CDDA119E25.jpg?PID50\" alt=\"\" />\r\n</p>','','127.0.0.1','1423969482');
INSERT INTO jh_home_site_item VALUES ('12','5','5','油漆验收','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_FBA247C8F109EE21C7769CCED799B613.jpg?PID51\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_C96B0EA5194CD5F909630D875887904A.jpg?PID52\" alt=\"\" />\r\n</p>','','127.0.0.1','1423969515');
INSERT INTO jh_home_site_item VALUES ('13','5','7','竣工验收','<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_B42F3EEA224EB6AA9B51CEDA86C11C57.jpg?PID53\" alt=\"\" />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"./attachs/demo/photo/201502/20150215_4D091A8446DF3F46F143DE26C4F4FCDE.jpg?PID54\" alt=\"\" />\r\n</p>','','127.0.0.1','1423969556');
DROP TABLE IF EXISTS jh_home_tuan;
CREATE TABLE `jh_home_tuan` (
  `tuan_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `home_id` mediumint(8) DEFAULT '0',
  `company_id` mediumint(8) DEFAULT '0',
  `sign_num` mediumint(8) DEFAULT '0',
  `qy_num` mediumint(8) DEFAULT '0',
  `sg_num` mediumint(8) DEFAULT '0',
  `stime` int(10) DEFAULT '0',
  `ltime` int(10) DEFAULT '0',
  `content` mediumtext,
  `audit` tinyint(1) DEFAULT '0',
  `jieyue` varchar(15) DEFAULT NULL,
  `clientip` char(15) DEFAULT NULL,
  `dateline` int(11) DEFAULT '0',
  PRIMARY KEY (`tuan_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;

INSERT INTO jh_home_tuan VALUES ('1','7','3','今朝北城，团装钜惠','20','15','122','52','0','1422720000','1427817600','','1','3500','127.0.0.1','1423899021');
INSERT INTO jh_home_tuan VALUES ('2','7','3','保利香槟新春特惠-青鸟装饰','18','39','86','10','0','1422720000','1427731200','','1','2500','127.0.0.1','1423900208');
INSERT INTO jh_home_tuan VALUES ('3','7','3','万科森林公园团装聚划算','3','21','212','52','0','1423929600','1427731200','','1','2500','127.0.0.1','1423900936');
INSERT INTO jh_home_tuan VALUES ('4','7','3','滨湖万科团装活动','7','28','94','52','0','1423929600','1429027200','','1','2500','127.0.0.1','1423901256');
INSERT INTO jh_home_tuan VALUES ('5','7','3','万科蓝山新春团装特惠','8','1','64','27','0','1422720000','1427731200','','1','3800','127.0.0.1','1423902126');
DROP TABLE IF EXISTS jh_home_tuan_sign;
CREATE TABLE `jh_home_tuan_sign` (
  `sign_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tuan_id` mediumint(8) DEFAULT NULL,
  `package_id` mediumint(8) DEFAULT NULL,
  `uid` mediumint(8) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`sign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 AUTO_INCREMENT=31;

DROP TABLE IF EXISTS jh_jforder;
CREATE TABLE `jh_jforder` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `product_id` mediumint(8) DEFAULT '0',
  `product_name` varchar(50) DEFAULT NULL,
  `product_num` smallint(6) DEFAULT NULL,
  `product_price` decimal(10,0) DEFAULT '0',
  `product_jfprice` smallint(6) DEFAULT '0',
  `jfamount` mediumint(8) DEFAULT '0',
  `contact` varchar(50) DEFAULT '0',
  `mobile` varchar(15) DEFAULT NULL,
  `addr` varchar(200) DEFAULT NULL,
  `note` varchar(255) DEFAULT '',
  `pay_status` tinyint(1) DEFAULT '0',
  `pay_time` int(10) DEFAULT '0',
  `order_status` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '1',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 AUTO_INCREMENT=82;

DROP TABLE IF EXISTS jh_jfproduct;
CREATE TABLE `jh_jfproduct` (
  `product_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `cat_id` smallint(6) DEFAULT '0',
  `brand_id` mediumint(8) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `jfprice` smallint(8) DEFAULT '0',
  `photo` varchar(150) DEFAULT NULL,
  `info` varchar(150) DEFAULT NULL,
  `viwes` mediumint(8) DEFAULT '0',
  `buys` mediumint(8) DEFAULT '0',
  `kucun` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

DROP TABLE IF EXISTS jh_links;
CREATE TABLE `jh_links` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `link` varchar(150) DEFAULT '',
  `logo` varchar(150) DEFAULT '',
  `desc` varchar(512) DEFAULT '',
  `city_id` smallint(5) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 AUTO_INCREMENT=37;

INSERT INTO jh_links VALUES ('31','江湖家居','http://www.ijh.cc','','','7','1','0','1422511581');
DROP TABLE IF EXISTS jh_mechanic;
CREATE TABLE `jh_mechanic` (
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `group_id` smallint(6) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `mobile` varchar(20) DEFAULT '',
  `qq` varchar(15) DEFAULT '',
  `tenders_sign` mediumint(8) DEFAULT '0',
  `tenders_num` mediumint(8) DEFAULT '0',
  `yuyue_num` mediumint(8) DEFAULT '0',
  `about` mediumtext,
  `views` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `flushtime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `orderby` (`orderby`,`flushtime`),
  KEY `__INDEX` (`city_id`,`area_id`,`audit`,`closed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_mechanic_attr;
CREATE TABLE `jh_mechanic_attr` (
  `uid` mediumint(8) unsigned NOT NULL,
  `attr_id` smallint(6) unsigned DEFAULT NULL,
  `attr_value_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_mechanic_yuyue;
CREATE TABLE `jh_mechanic_yuyue` (
  `yuyue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mechanic_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `contact` varchar(20) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`yuyue_id`),
  KEY `__INDEX` (`mechanic_id`,`uid`,`city_id`,`dateline`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;

DROP TABLE IF EXISTS jh_member;
CREATE TABLE `jh_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` smallint(6) DEFAULT '0',
  `uname` varchar(50) DEFAULT '',
  `passwd` char(32) DEFAULT '',
  `from` enum('member','shop','company','mechanic','designer','gz') DEFAULT 'member',
  `mail` varchar(100) DEFAULT '@',
  `mobile` varchar(15) DEFAULT '',
  `credits` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `gender` enum('man','woman') DEFAULT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `realname` varchar(50) DEFAULT '',
  `face` varchar(150) DEFAULT '',
  `face_80` varchar(150) DEFAULT '',
  `face_32` varchar(150) DEFAULT '',
  `Y` smallint(4) DEFAULT '0',
  `M` tinyint(2) DEFAULT '0',
  `D` tinyint(2) DEFAULT '0',
  `verify` tinyint(1) unsigned DEFAULT '0',
  `uc_uid` mediumint(8) DEFAULT '0',
  `jifen` int(10) DEFAULT '0',
  `cart` varchar(1024) DEFAULT '',
  `lastlogin` int(10) unsigned DEFAULT '0',
  `loginip` char(15) DEFAULT '0.0.0.0',
  `truste_money` decimal(10,2) DEFAULT '0.00',
  `closed` tinyint(1) unsigned DEFAULT '0',
  `regip` char(15) DEFAULT '0.0.0.0',
  `dateline` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `uname` (`uname`),
  KEY `mail` (`mail`),
  KEY `mobile` (`mobile`),
  KEY `uc_uid` (`uc_uid`),
  KEY `__INDEX` (`verify`,`closed`,`dateline`,`from`,`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=utf8 AUTO_INCREMENT=271;

INSERT INTO jh_member VALUES ('1','2','汀凡装饰工程公司','978c5a10e91fce68b8468596cb7f1147','designer','faf551437d@ijh.cc','','0','0','woman','7','','demo/face/C4C/180/C4CA4238A0B923820DCC509A6F75849B.jpg','demo/face/C4C/80/C4CA4238A0B923820DCC509A6F75849B.jpg','demo/face/C4C/32/C4CA4238A0B923820DCC509A6F75849B.jpg','0','0','0','0','0','0','','1423884803','127.0.0.1','0.00','0','127.0.0.1','1423884803');
INSERT INTO jh_member VALUES ('2','2','徐志傑','3b79e8fee9183c8b4be3502b75bbc700','designer','4ae320a3e4@ijh.cc','','0','0','woman','7','','demo/face/C81/180/C81E728D9D4C2F636F067F89CC14862C.jpg','demo/face/C81/80/C81E728D9D4C2F636F067F89CC14862C.jpg','demo/face/C81/32/C81E728D9D4C2F636F067F89CC14862C.jpg','0','0','0','0','0','0','','1423884803','127.0.0.1','0.00','0','127.0.0.1','1423884803');
INSERT INTO jh_member VALUES ('3','2','一筑良品','3191c259560548819ce52efb68531f1f','designer','9e4db99003@ijh.cc','','0','0','woman','7','','demo/face/ECC/180/ECCBC87E4B5CE2FE28308FD9F2A7BAF3.jpg','demo/face/ECC/80/ECCBC87E4B5CE2FE28308FD9F2A7BAF3.jpg','demo/face/ECC/32/ECCBC87E4B5CE2FE28308FD9F2A7BAF3.jpg','0','0','0','0','0','0','','1423884804','127.0.0.1','0.00','0','127.0.0.1','1423884804');
INSERT INTO jh_member VALUES ('4','2','龚德成','ba75458648c291e5ea0162272e9d5ea0','designer','5a6fb57109@ijh.cc','','0','0','woman','7','','demo/face/A87/180/A87FF679A2F3E71D9181A67B7542122C.jpg','demo/face/A87/80/A87FF679A2F3E71D9181A67B7542122C.jpg','demo/face/A87/32/A87FF679A2F3E71D9181A67B7542122C.jpg','0','0','0','0','0','0','','1423884804','127.0.0.1','0.00','0','127.0.0.1','1423884804');
INSERT INTO jh_member VALUES ('5','2','刘志雷','ed82715d461a199d2352d1011f6ba148','designer','7565434c5e@ijh.cc','','0','0','woman','7','','demo/face/E4D/180/E4DA3B7FBBCE2345D7772B0674A318D5.jpg','demo/face/E4D/80/E4DA3B7FBBCE2345D7772B0674A318D5.jpg','demo/face/E4D/32/E4DA3B7FBBCE2345D7772B0674A318D5.jpg','0','0','0','0','0','0','','1423884804','127.0.0.1','0.00','0','127.0.0.1','1423884804');
INSERT INTO jh_member VALUES ('6','2','胭脂设计事务所','405f820df9f4a7ed07b177a03fd7318b','designer','910de7bdce@ijh.cc','','0','0','woman','7','','demo/face/167/180/1679091C5A880FAF6FB5E6087EB1B2DC.jpg','demo/face/167/80/1679091C5A880FAF6FB5E6087EB1B2DC.jpg','demo/face/167/32/1679091C5A880FAF6FB5E6087EB1B2DC.jpg','0','0','0','0','0','0','','1423884804','127.0.0.1','0.00','0','127.0.0.1','1423884804');
INSERT INTO jh_member VALUES ('7','2','KOMA-高玛设计','581ddc163f57e7034af1920f3b40033f','designer','0c53dc7a1c@ijh.cc','','0','0','woman','7','','demo/face/8F1/180/8F14E45FCEEA167A5A36DEDD4BEA2543.jpg','demo/face/8F1/80/8F14E45FCEEA167A5A36DEDD4BEA2543.jpg','demo/face/8F1/32/8F14E45FCEEA167A5A36DEDD4BEA2543.jpg','0','0','0','0','0','0','','1423884804','127.0.0.1','0.00','0','127.0.0.1','1423884804');
INSERT INTO jh_member VALUES ('8','2','十方设计机构','ce020aa2c63ea562a33f8c4858fbe3a4','designer','1a51367d40@ijh.cc','','0','0','woman','7','','demo/face/C9F/180/C9F0F895FB98AB9159F51FD0297E236D.jpg','demo/face/C9F/80/C9F0F895FB98AB9159F51FD0297E236D.jpg','demo/face/C9F/32/C9F0F895FB98AB9159F51FD0297E236D.jpg','0','0','0','0','0','0','','1423884805','127.0.0.1','0.00','0','127.0.0.1','1423884805');
INSERT INTO jh_member VALUES ('9','2','吴文粒','e029e4467e7e2134abaacb97b0fc5fc5','designer','cb5fb8b086@ijh.cc','','0','0','woman','7','','demo/face/45C/180/45C48CCE2E2D7FBDEA1AFC51C7C6AD26.jpg','demo/face/45C/80/45C48CCE2E2D7FBDEA1AFC51C7C6AD26.jpg','demo/face/45C/32/45C48CCE2E2D7FBDEA1AFC51C7C6AD26.jpg','0','0','0','0','0','0','','1423884805','127.0.0.1','0.00','0','127.0.0.1','1423884805');
INSERT INTO jh_member VALUES ('10','2','林昀室内设计','b27bd9d01127ec60a278193852b5be11','designer','c1f4c279cc@ijh.cc','','0','0','woman','7','','demo/face/D3D/180/D3D9446802A44259755D38E6D163E820.jpg','demo/face/D3D/80/D3D9446802A44259755D38E6D163E820.jpg','demo/face/D3D/32/D3D9446802A44259755D38E6D163E820.jpg','0','0','0','0','0','0','','1423884805','127.0.0.1','0.00','0','127.0.0.1','1423884805');
INSERT INTO jh_member VALUES ('11','2','孙立荣','f554ab0098a0a2753171e8155c577137','designer','de75dd9158@ijh.cc','','0','0','woman','7','','demo/face/651/180/6512BD43D9CAA6E02C990B0A82652DCA.jpg','demo/face/651/80/6512BD43D9CAA6E02C990B0A82652DCA.jpg','demo/face/651/32/6512BD43D9CAA6E02C990B0A82652DCA.jpg','0','0','0','0','0','0','','1423884806','127.0.0.1','0.00','0','127.0.0.1','1423884806');
INSERT INTO jh_member VALUES ('12','2','孔亮','f5c4edef060b18cf008822a9808158e1','designer','a79143e90f@ijh.cc','','0','0','woman','7','','demo/face/C20/180/C20AD4D76FE97759AA27A0C99BFF6710.jpg','demo/face/C20/80/C20AD4D76FE97759AA27A0C99BFF6710.jpg','demo/face/C20/32/C20AD4D76FE97759AA27A0C99BFF6710.jpg','0','0','0','0','0','0','','1423884806','127.0.0.1','0.00','0','127.0.0.1','1423884806');
INSERT INTO jh_member VALUES ('13','2','沈玲玲','66334a4c624365e3efc454ca8e8dba59','designer','7e4062d66d@ijh.cc','','0','0','woman','7','','demo/face/C51/180/C51CE410C124A10E0DB5E4B97FC2AF39.jpg','demo/face/C51/80/C51CE410C124A10E0DB5E4B97FC2AF39.jpg','demo/face/C51/32/C51CE410C124A10E0DB5E4B97FC2AF39.jpg','0','0','0','0','0','0','','1423884806','127.0.0.1','0.00','0','127.0.0.1','1423884806');
INSERT INTO jh_member VALUES ('14','2','万天高品质效果图','1f544cfeca3069926f7407df3a7e4321','designer','ee91e0b4de@ijh.cc','','0','0','woman','7','','demo/face/AAB/180/AAB3238922BCC25A6F606EB525FFDC56.jpg','demo/face/AAB/80/AAB3238922BCC25A6F606EB525FFDC56.jpg','demo/face/AAB/32/AAB3238922BCC25A6F606EB525FFDC56.jpg','0','0','0','0','0','0','','1423884806','127.0.0.1','0.00','0','127.0.0.1','1423884806');
INSERT INTO jh_member VALUES ('15','2','合肥卡乐','e66bf0e3560c43efefe375b4415ae68f','designer','eaa6ef9db0@ijh.cc','','0','0','woman','7','','demo/face/9BF/180/9BF31C7FF062936A96D3C8BD1F8F2FF3.jpg','demo/face/9BF/80/9BF31C7FF062936A96D3C8BD1F8F2FF3.jpg','demo/face/9BF/32/9BF31C7FF062936A96D3C8BD1F8F2FF3.jpg','0','0','0','0','0','0','','1423884807','127.0.0.1','0.00','0','127.0.0.1','1423884807');
INSERT INTO jh_member VALUES ('16','2','李发枝','26459357c2e496b9b2000552b5389e32','designer','8fe6befc8d@ijh.cc','','0','0','woman','7','','demo/face/C74/180/C74D97B01EAE257E44AA9D5BADE97BAF.jpg','demo/face/C74/80/C74D97B01EAE257E44AA9D5BADE97BAF.jpg','demo/face/C74/32/C74D97B01EAE257E44AA9D5BADE97BAF.jpg','0','0','0','0','0','0','','1423884807','127.0.0.1','0.00','0','127.0.0.1','1423884807');
INSERT INTO jh_member VALUES ('17','2','钟莉','9677fdfec55658467d91afe175b7d02b','designer','0372e05378@ijh.cc','','0','0','woman','7','','demo/face/70E/180/70EFDF2EC9B086079795C442636B55FB.jpg','demo/face/70E/80/70EFDF2EC9B086079795C442636B55FB.jpg','demo/face/70E/32/70EFDF2EC9B086079795C442636B55FB.jpg','0','0','0','0','0','0','','1423884807','127.0.0.1','0.00','0','127.0.0.1','1423884807');
INSERT INTO jh_member VALUES ('18','2','MikaLilys','fc26fdec48de3c00538a1094c63571e8','designer','5b400e5865@ijh.cc','','0','0','woman','7','','demo/face/6F4/180/6F4922F45568161A8CDF4AD2299F6D23.jpg','demo/face/6F4/80/6F4922F45568161A8CDF4AD2299F6D23.jpg','demo/face/6F4/32/6F4922F45568161A8CDF4AD2299F6D23.jpg','0','0','0','0','0','0','','1423884807','127.0.0.1','0.00','0','127.0.0.1','1423884807');
INSERT INTO jh_member VALUES ('19','2','蒋克勤','269bf23319c7190ed9622348700f145b','designer','cdfa4f1d43@ijh.cc','','0','0','woman','7','','demo/face/1F0/180/1F0E3DAD99908345F7439F8FFABDFFC4.jpg','demo/face/1F0/80/1F0E3DAD99908345F7439F8FFABDFFC4.jpg','demo/face/1F0/32/1F0E3DAD99908345F7439F8FFABDFFC4.jpg','0','0','0','0','0','0','','1423884808','127.0.0.1','0.00','0','127.0.0.1','1423884808');
INSERT INTO jh_member VALUES ('20','2','合肥孔亮','ed67c43330180e1026fc424a4754fce0','designer','80d351fd00@ijh.cc','','0','0','woman','7','','demo/face/98F/180/98F13708210194C475687BE6106A3B84.jpg','demo/face/98F/80/98F13708210194C475687BE6106A3B84.jpg','demo/face/98F/32/98F13708210194C475687BE6106A3B84.jpg','0','0','0','0','0','0','','1423884808','127.0.0.1','0.00','0','127.0.0.1','1423884808');
INSERT INTO jh_member VALUES ('21','2','胡狸','4c0fe016c7badd6da384ca023ec22b65','designer','0f46c41b80@ijh.cc','','0','0','woman','7','','demo/face/3C5/180/3C59DC048E8850243BE8079A5C74D079.jpg','demo/face/3C5/80/3C59DC048E8850243BE8079A5C74D079.jpg','demo/face/3C5/32/3C59DC048E8850243BE8079A5C74D079.jpg','0','0','0','0','0','0','','1423884808','127.0.0.1','0.00','0','127.0.0.1','1423884808');
INSERT INTO jh_member VALUES ('22','2','张浩','16df8a3d1cd6df53135abf926a29623c','designer','5f650ebe8c@ijh.cc','','0','0','woman','7','','demo/face/B6D/180/B6D767D2F8ED5D21A44B0E5886680CB9.jpg','demo/face/B6D/80/B6D767D2F8ED5D21A44B0E5886680CB9.jpg','demo/face/B6D/32/B6D767D2F8ED5D21A44B0E5886680CB9.jpg','0','0','0','0','0','0','','1423884809','127.0.0.1','0.00','0','127.0.0.1','1423884809');
INSERT INTO jh_member VALUES ('23','2','微醺小桔','82e3926486807615c96c8c6338fe93f6','designer','c34fc215e4@ijh.cc','','0','0','woman','7','','demo/face/376/180/37693CFC748049E45D87B8C7D8B9AACD.jpg','demo/face/376/80/37693CFC748049E45D87B8C7D8B9AACD.jpg','demo/face/376/32/37693CFC748049E45D87B8C7D8B9AACD.jpg','0','0','0','0','0','0','','1423884809','127.0.0.1','0.00','0','127.0.0.1','1423884809');
INSERT INTO jh_member VALUES ('24','2','程诺','1c05994e8c15781feb89993930e5c7f7','designer','05291a5302@ijh.cc','','0','0','woman','7','','demo/face/1FF/180/1FF1DE774005F8DA13F42943881C655F.jpg','demo/face/1FF/80/1FF1DE774005F8DA13F42943881C655F.jpg','demo/face/1FF/32/1FF1DE774005F8DA13F42943881C655F.jpg','0','0','0','0','0','0','','1423884809','127.0.0.1','0.00','0','127.0.0.1','1423884809');
INSERT INTO jh_member VALUES ('25','2','洪尧','f41221fc16e1c2b5fa4da10931074600','designer','c8e8d804a1@ijh.cc','','0','0','woman','7','','demo/face/8E2/180/8E296A067A37563370DED05F5A3BF3EC.jpg','demo/face/8E2/80/8E296A067A37563370DED05F5A3BF3EC.jpg','demo/face/8E2/32/8E296A067A37563370DED05F5A3BF3EC.jpg','0','0','0','0','0','0','','1423884810','127.0.0.1','0.00','0','127.0.0.1','1423884810');
INSERT INTO jh_member VALUES ('26','2','马远亮','247809127fb8372335e5bca5d74727d6','designer','1dab46d997@ijh.cc','','0','0','woman','7','','demo/face/4E7/180/4E732CED3463D06DE0CA9A15B6153677.jpg','demo/face/4E7/80/4E732CED3463D06DE0CA9A15B6153677.jpg','demo/face/4E7/32/4E732CED3463D06DE0CA9A15B6153677.jpg','0','0','0','0','0','0','','1423884810','127.0.0.1','0.00','0','127.0.0.1','1423884810');
INSERT INTO jh_member VALUES ('27','2','李超','e364179e17774deb87c38a89c66eebec','designer','21f1401c80@ijh.cc','','0','0','woman','7','','demo/face/02E/180/02E74F10E0327AD868D138F2B4FDD6F0.jpg','demo/face/02E/80/02E74F10E0327AD868D138F2B4FDD6F0.jpg','demo/face/02E/32/02E74F10E0327AD868D138F2B4FDD6F0.jpg','0','0','0','0','0','0','','1423884810','127.0.0.1','0.00','0','127.0.0.1','1423884810');
INSERT INTO jh_member VALUES ('28','2','郝泽伟','6532f3cba465558bfe454d48109fe28d','designer','ca093c8e39@ijh.cc','','0','0','woman','7','','demo/face/33E/180/33E75FF09DD601BBE69F351039152189.jpg','demo/face/33E/80/33E75FF09DD601BBE69F351039152189.jpg','demo/face/33E/32/33E75FF09DD601BBE69F351039152189.jpg','0','0','0','0','0','0','','1423884811','127.0.0.1','0.00','0','127.0.0.1','1423884811');
INSERT INTO jh_member VALUES ('29','2','渔翁设计','075fb0cdcbde70a76a80278edaf6270c','designer','b1f2d5f427@ijh.cc','','0','0','woman','7','','demo/face/6EA/180/6EA9AB1BAA0EFB9E19094440C317E21B.jpg','demo/face/6EA/80/6EA9AB1BAA0EFB9E19094440C317E21B.jpg','demo/face/6EA/32/6EA9AB1BAA0EFB9E19094440C317E21B.jpg','0','0','0','0','0','0','','1423884811','127.0.0.1','0.00','0','127.0.0.1','1423884811');
INSERT INTO jh_member VALUES ('30','2','A-TM设计','a17404ce68dc79915a8867679b02c3c7','designer','6ea3c57491@ijh.cc','','0','0','woman','7','','demo/face/341/180/34173CB38F07F89DDBEBC2AC9128303F.jpg','demo/face/341/80/34173CB38F07F89DDBEBC2AC9128303F.jpg','demo/face/341/32/34173CB38F07F89DDBEBC2AC9128303F.jpg','0','0','0','0','0','0','','1423884811','127.0.0.1','0.00','0','127.0.0.1','1423884811');
INSERT INTO jh_member VALUES ('31','2','卡卡','49b3babebd81ccba5bde375a0da9c1b9','designer','c973fbeea8@ijh.cc','','0','0','woman','7','','demo/face/C16/180/C16A5320FA475530D9583C34FD356EF5.jpg','demo/face/C16/80/C16A5320FA475530D9583C34FD356EF5.jpg','demo/face/C16/32/C16A5320FA475530D9583C34FD356EF5.jpg','0','0','0','0','0','0','','1423884812','127.0.0.1','0.00','0','127.0.0.1','1423884812');
INSERT INTO jh_member VALUES ('32','2','印颜设计','d8d51c972ef5b0b387f8ed7d4c3872e0','designer','5355df1747@ijh.cc','','0','0','woman','7','','demo/face/636/180/6364D3F0F495B6AB9DCF8D3B5C6E0B01.jpg','demo/face/636/80/6364D3F0F495B6AB9DCF8D3B5C6E0B01.jpg','demo/face/636/32/6364D3F0F495B6AB9DCF8D3B5C6E0B01.jpg','0','0','0','0','0','0','','1423884812','127.0.0.1','0.00','0','127.0.0.1','1423884812');
INSERT INTO jh_member VALUES ('33','2','John','31e763ffbaec3419a20b4c5cd5804847','designer','fd47d4a533@ijh.cc','','0','0','woman','7','','demo/face/182/180/182BE0C5CDCD5072BB1864CDEE4D3D6E.jpg','demo/face/182/80/182BE0C5CDCD5072BB1864CDEE4D3D6E.jpg','demo/face/182/32/182BE0C5CDCD5072BB1864CDEE4D3D6E.jpg','0','0','0','0','0','0','','1423884813','127.0.0.1','0.00','0','127.0.0.1','1423884813');
INSERT INTO jh_member VALUES ('34','2','程娟','6e5f4b0b4f581f3268cb331ae93e3aab','designer','78c1c1f4b2@ijh.cc','','0','0','woman','7','','demo/face/E36/180/E369853DF766FA44E1ED0FF613F563BD.jpg','demo/face/E36/80/E369853DF766FA44E1ED0FF613F563BD.jpg','demo/face/E36/32/E369853DF766FA44E1ED0FF613F563BD.jpg','0','0','0','0','0','0','','1423884813','127.0.0.1','0.00','0','127.0.0.1','1423884813');
INSERT INTO jh_member VALUES ('35','2','朱其飞','112a0afc562e914bc8d5cda3f597da4b','designer','618efa681c@ijh.cc','','0','0','woman','7','','demo/face/1C3/180/1C383CD30B7C298AB50293ADFECB7B18.jpg','demo/face/1C3/80/1C383CD30B7C298AB50293ADFECB7B18.jpg','demo/face/1C3/32/1C383CD30B7C298AB50293ADFECB7B18.jpg','0','0','0','0','0','0','','1423884814','127.0.0.1','0.00','0','127.0.0.1','1423884814');
INSERT INTO jh_member VALUES ('36','2','夕阳下的青春','09536d52e49519f3625292eae69bed42','designer','c920252d2d@ijh.cc','','0','0','woman','7','','demo/face/19C/180/19CA14E7EA6328A42E0EB13D585E4C22.jpg','demo/face/19C/80/19CA14E7EA6328A42E0EB13D585E4C22.jpg','demo/face/19C/32/19CA14E7EA6328A42E0EB13D585E4C22.jpg','0','0','0','0','0','0','','1423884814','127.0.0.1','0.00','0','127.0.0.1','1423884814');
INSERT INTO jh_member VALUES ('37','2','澤田設計_胡勇','d189e6421ab4a81c8e21bc009d7c4c1b','designer','00786e6821@ijh.cc','','0','0','woman','7','','demo/face/A5B/180/A5BFC9E07964F8DDDEB95FC584CD965D.jpg','demo/face/A5B/80/A5BFC9E07964F8DDDEB95FC584CD965D.jpg','demo/face/A5B/32/A5BFC9E07964F8DDDEB95FC584CD965D.jpg','0','0','0','0','0','0','','1423884814','127.0.0.1','0.00','0','127.0.0.1','1423884814');
INSERT INTO jh_member VALUES ('38','2','谢工','1ef8f735d0a990412bdd3eaf740e2673','designer','de45e59490@ijh.cc','','0','0','woman','7','','demo/face/A57/180/A5771BCE93E200C36F7CD9DFD0E5DEAA.jpg','demo/face/A57/80/A5771BCE93E200C36F7CD9DFD0E5DEAA.jpg','demo/face/A57/32/A5771BCE93E200C36F7CD9DFD0E5DEAA.jpg','0','0','0','0','0','0','','1423884815','127.0.0.1','0.00','0','127.0.0.1','1423884815');
INSERT INTO jh_member VALUES ('39','2','郭敏','d391edfba94869751288939984fbfd8f','designer','f936cc0adc@ijh.cc','','0','0','woman','7','','demo/face/D67/180/D67D8AB4F4C10BF22AA353E27879133C.jpg','demo/face/D67/80/D67D8AB4F4C10BF22AA353E27879133C.jpg','demo/face/D67/32/D67D8AB4F4C10BF22AA353E27879133C.jpg','0','0','0','0','0','0','','1423884815','127.0.0.1','0.00','0','127.0.0.1','1423884815');
INSERT INTO jh_member VALUES ('40','2','鼎信室内外设计','c897c620b75550706dbd5c1dbe51392c','designer','722c90b7b0@ijh.cc','','0','0','woman','7','','demo/face/D64/180/D645920E395FEDAD7BBBED0ECA3FE2E0.jpg','demo/face/D64/80/D645920E395FEDAD7BBBED0ECA3FE2E0.jpg','demo/face/D64/32/D645920E395FEDAD7BBBED0ECA3FE2E0.jpg','0','0','0','0','0','0','','1423884815','127.0.0.1','0.00','0','127.0.0.1','1423884815');
INSERT INTO jh_member VALUES ('41','2','王其金','a536d423d307fcdefb864a60b01c5d63','designer','8b612ffbc1@ijh.cc','','0','0','woman','7','','demo/face/341/180/3416A75F4CEA9109507CACD8E2F2AEFC.jpg','demo/face/341/80/3416A75F4CEA9109507CACD8E2F2AEFC.jpg','demo/face/341/32/3416A75F4CEA9109507CACD8E2F2AEFC.jpg','0','0','0','0','0','0','','1423884816','127.0.0.1','0.00','0','127.0.0.1','1423884816');
INSERT INTO jh_member VALUES ('42','2','方涛','3dc8b5c9c984ac0ed05bf2e72a09db64','designer','e1d745c830@ijh.cc','','0','0','woman','7','','demo/face/A1D/180/A1D0C6E83F027327D8461063F4AC58A6.jpg','demo/face/A1D/80/A1D0C6E83F027327D8461063F4AC58A6.jpg','demo/face/A1D/32/A1D0C6E83F027327D8461063F4AC58A6.jpg','0','0','0','0','0','0','','1423884816','127.0.0.1','0.00','0','127.0.0.1','1423884816');
INSERT INTO jh_member VALUES ('43','2','岳阳','8dfbfa964c2fd852368924d2089e07d6','designer','c1870f1ec5@ijh.cc','','0','0','woman','7','','demo/face/17E/180/17E62166FC8586DFA4D1BC0E1742C08B.jpg','demo/face/17E/80/17E62166FC8586DFA4D1BC0E1742C08B.jpg','demo/face/17E/32/17E62166FC8586DFA4D1BC0E1742C08B.jpg','0','0','0','0','0','0','','1423884817','127.0.0.1','0.00','0','127.0.0.1','1423884817');
INSERT INTO jh_member VALUES ('44','2','郭韦松','5977c3f7bbd25b056175cc3c0ef25799','designer','a88e2e951f@ijh.cc','','0','0','woman','7','','demo/face/F71/180/F7177163C833DFF4B38FC8D2872F1EC6.jpg','demo/face/F71/80/F7177163C833DFF4B38FC8D2872F1EC6.jpg','demo/face/F71/32/F7177163C833DFF4B38FC8D2872F1EC6.jpg','0','0','0','0','0','0','','1423884819','127.0.0.1','0.00','0','127.0.0.1','1423884819');
INSERT INTO jh_member VALUES ('45','2','吴文志','b7cbf2aab27a07f4f67464ea946a5b3d','designer','ecf555fa70@ijh.cc','','0','0','woman','7','','demo/face/6C8/180/6C8349CC7260AE62E3B1396831A8398F.jpg','demo/face/6C8/80/6C8349CC7260AE62E3B1396831A8398F.jpg','demo/face/6C8/32/6C8349CC7260AE62E3B1396831A8398F.jpg','0','0','0','0','0','0','','1423884819','127.0.0.1','0.00','0','127.0.0.1','1423884819');
INSERT INTO jh_member VALUES ('46','2','罗春颜','a16fd4244585d569d70984458a6b5ae6','designer','7e93b2c512@ijh.cc','','0','0','woman','7','','demo/face/D9D/180/D9D4F495E875A2E075A1A4A6E1B9770F.jpg','demo/face/D9D/80/D9D4F495E875A2E075A1A4A6E1B9770F.jpg','demo/face/D9D/32/D9D4F495E875A2E075A1A4A6E1B9770F.jpg','0','0','0','0','0','0','','1423884820','127.0.0.1','0.00','0','127.0.0.1','1423884820');
INSERT INTO jh_member VALUES ('47','2','瀚宇室内设计','b2d11c02fbac9d8548dcd9c7f8ae6088','designer','86426ace4d@ijh.cc','','0','0','woman','7','','demo/face/67C/180/67C6A1E7CE56D3D6FA748AB6D9AF3FD7.jpg','demo/face/67C/80/67C6A1E7CE56D3D6FA748AB6D9AF3FD7.jpg','demo/face/67C/32/67C6A1E7CE56D3D6FA748AB6D9AF3FD7.jpg','0','0','0','0','0','0','','1423884821','127.0.0.1','0.00','0','127.0.0.1','1423884821');
INSERT INTO jh_member VALUES ('48','2','郭一龙','c4262bb755ee2ffe09359b438a46ea19','designer','f089553e5a@ijh.cc','','0','0','woman','7','','demo/face/642/180/642E92EFB79421734881B53E1E1B18B6.jpg','demo/face/642/80/642E92EFB79421734881B53E1E1B18B6.jpg','demo/face/642/32/642E92EFB79421734881B53E1E1B18B6.jpg','0','0','0','0','0','0','','1423884822','127.0.0.1','0.00','0','127.0.0.1','1423884822');
INSERT INTO jh_member VALUES ('49','2','丰崴','ff20575095d4418c454fa815cb64448e','designer','4dca963ea3@ijh.cc','','0','0','woman','7','','demo/face/F45/180/F457C545A9DED88F18ECEE47145A72C0.jpg','demo/face/F45/80/F457C545A9DED88F18ECEE47145A72C0.jpg','demo/face/F45/32/F457C545A9DED88F18ECEE47145A72C0.jpg','0','0','0','0','0','0','','1423884822','127.0.0.1','0.00','0','127.0.0.1','1423884822');
INSERT INTO jh_member VALUES ('50','2','管雷雷','c93b499222efd8cf4150cb7e4dfefb37','designer','54dadb66db@ijh.cc','','0','0','woman','7','','demo/face/C0C/180/C0C7C76D30BD3DCAEFC96F40275BDC0A.jpg','demo/face/C0C/80/C0C7C76D30BD3DCAEFC96F40275BDC0A.jpg','demo/face/C0C/32/C0C7C76D30BD3DCAEFC96F40275BDC0A.jpg','0','0','0','0','0','0','','1423884823','127.0.0.1','0.00','0','127.0.0.1','1423884823');
INSERT INTO jh_member VALUES ('51','2','名构设计','cc9f6b49db03dae02b59b6ce84a6f66e','designer','d41428ec41@ijh.cc','','0','0','woman','7','','demo/face/283/180/2838023A778DFAECDC212708F721B788.jpg','demo/face/283/80/2838023A778DFAECDC212708F721B788.jpg','demo/face/283/32/2838023A778DFAECDC212708F721B788.jpg','0','0','0','0','0','0','','1423884824','127.0.0.1','0.00','0','127.0.0.1','1423884824');
INSERT INTO jh_member VALUES ('52','4','今朝装饰','93279e3308bdbbeed946fc965017f67a','company','jinzhao@ijh.cc','','0','0','','0','','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423966297');
INSERT INTO jh_member VALUES ('53','4','东箭装饰','93279e3308bdbbeed946fc965017f67a','company','dongjian@ijh.cc','','0','0','','0','东箭装饰','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423967456');
INSERT INTO jh_member VALUES ('54','4','青鸟装饰','93279e3308bdbbeed946fc965017f67a','company','qingniao@ijh.cc','','0','0','','0','青鸟装饰','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423968243');
INSERT INTO jh_member VALUES ('55','4','旺角装饰','93279e3308bdbbeed946fc965017f67a','company','wangjiao@ijh.cc','','0','0','','0','旺角装饰','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423968842');
INSERT INTO jh_member VALUES ('56','4','峻朗装饰','93279e3308bdbbeed946fc965017f67a','company','junlang@ijh.cc','','0','0','','0','峻朗装饰','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423969236');
INSERT INTO jh_member VALUES ('145','6','钱工长221','93279e3308bdbbeed946fc965017f67a','gz','1180462@ijh.cc','','0','0','woman','7','','demo/face/face_29.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('144','6','鲁工长741','93279e3308bdbbeed946fc965017f67a','gz','4000845@ijh.cc','','0','0','woman','7','','demo/face/face_28.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('143','6','戴工长357','93279e3308bdbbeed946fc965017f67a','gz','8456308@ijh.cc','','0','0','woman','7','','demo/face/face_27.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('142','6','何工长955','93279e3308bdbbeed946fc965017f67a','gz','7581407@ijh.cc','','0','0','woman','7','','demo/face/face_26.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('141','6','郭工长607','93279e3308bdbbeed946fc965017f67a','gz','8413247@ijh.cc','','0','0','woman','7','','demo/face/face_25.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('140','6','鲁工长577','93279e3308bdbbeed946fc965017f67a','gz','5740919@ijh.cc','','0','0','woman','7','','demo/face/face_24.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('139','6','郑工长724','93279e3308bdbbeed946fc965017f67a','gz','9119054@ijh.cc','','0','0','woman','7','','demo/face/face_23.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('138','6','周工长784','93279e3308bdbbeed946fc965017f67a','gz','6173953@ijh.cc','','0','0','woman','7','','demo/face/face_22.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('137','6','单工长778','93279e3308bdbbeed946fc965017f67a','gz','5668800@ijh.cc','','0','0','woman','7','','demo/face/face_21.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('136','6','施工长944','93279e3308bdbbeed946fc965017f67a','gz','2228903@ijh.cc','','0','0','woman','7','','demo/face/face_20.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('135','6','孙工长931','93279e3308bdbbeed946fc965017f67a','gz','1183585@ijh.cc','','0','0','woman','7','','demo/face/face_19.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('134','6','何工长951','93279e3308bdbbeed946fc965017f67a','gz','1548908@ijh.cc','','0','0','woman','7','','demo/face/face_18.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('133','6','鲁工长815','93279e3308bdbbeed946fc965017f67a','gz','9117500@ijh.cc','','0','0','woman','7','','demo/face/face_17.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('132','6','何工长936','93279e3308bdbbeed946fc965017f67a','gz','8877175@ijh.cc','','0','0','woman','7','','demo/face/face_16.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('131','6','孙工长781','93279e3308bdbbeed946fc965017f67a','gz','7320387@ijh.cc','','0','0','woman','7','','demo/face/face_15.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('130','6','鲁工长650','93279e3308bdbbeed946fc965017f67a','gz','1894505@ijh.cc','','0','0','woman','7','','demo/face/face_14.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('129','6','赵工长502','93279e3308bdbbeed946fc965017f67a','gz','2963538@ijh.cc','','0','0','woman','7','','demo/face/face_13.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('128','6','赵工长895','93279e3308bdbbeed946fc965017f67a','gz','1346971@ijh.cc','','0','0','woman','7','','demo/face/face_12.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('127','6','赵工长544','93279e3308bdbbeed946fc965017f67a','gz','1928518@ijh.cc','','0','0','woman','7','','demo/face/face_11.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('126','6','施工长963','93279e3308bdbbeed946fc965017f67a','gz','2479986@ijh.cc','','0','0','woman','7','','demo/face/face_10.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('125','6','单工长757','93279e3308bdbbeed946fc965017f67a','gz','7709214@ijh.cc','','0','0','woman','7','','demo/face/face_9.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('124','6','杨工长293','93279e3308bdbbeed946fc965017f67a','gz','1667569@ijh.cc','','0','0','woman','7','','demo/face/face_8.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('123','6','鲁工长446','93279e3308bdbbeed946fc965017f67a','gz','6348588@ijh.cc','','0','0','woman','7','','demo/face/face_7.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('122','6','鲁工长680','93279e3308bdbbeed946fc965017f67a','gz','7717072@ijh.cc','','0','0','woman','7','','demo/face/face_6.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('121','6','孙工长487','93279e3308bdbbeed946fc965017f67a','gz','5172127@ijh.cc','','0','0','woman','7','','demo/face/face_5.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('120','6','蒋工长480','93279e3308bdbbeed946fc965017f67a','gz','8548299@ijh.cc','','0','0','woman','7','','demo/face/face_4.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('119','6','戴工长443','93279e3308bdbbeed946fc965017f67a','gz','3416131@ijh.cc','','0','0','woman','7','','demo/face/face_3.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('118','6','钱工长351','93279e3308bdbbeed946fc965017f67a','gz','2164067@ijh.cc','','0','0','woman','7','','demo/face/face_2.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('117','6','蒋工长368','93279e3308bdbbeed946fc965017f67a','gz','5797772@ijh.cc','','0','0','woman','7','','demo/face/face_1.jpg','','','0','0','0','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423974228');
INSERT INTO jh_member VALUES ('146','1','张小美','93279e3308bdbbeed946fc965017f67a','member','xiaomei@ijh.cc','','0','0','','0','张小美','demo/face/A5E/180/A5E00132373A7031000FD987A3C9F87B.jpg','demo/face/A5E/80/A5E00132373A7031000FD987A3C9F87B.jpg','demo/face/A5E/32/A5E00132373A7031000FD987A3C9F87B.jpg','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423982371');
INSERT INTO jh_member VALUES ('147','1','老猫','93279e3308bdbbeed946fc965017f67a','member','laomao@ijh.cc','','0','0','','0','老猫','demo/face/8D5/180/8D5E957F297893487BD98FA830FA6413.jpg','demo/face/8D5/80/8D5E957F297893487BD98FA830FA6413.jpg','demo/face/8D5/32/8D5E957F297893487BD98FA830FA6413.jpg','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423982814');
INSERT INTO jh_member VALUES ('148','7','粤鑫家居','93279e3308bdbbeed946fc965017f67a','shop','yuexin@ijh.cc','','0','0','','0','','','','','2015','2','15','0','0','0','','0','0.0.0.0','0.00','0','127.0.0.1','1423985554');
INSERT INTO jh_member VALUES ('270','1','yuaneryuan','70eb60fbf2832e0c6e00f7e7484c88f9','member','yuaneryuan@163.com','','0','0','woman','7','','','','','0','0','0','0','0','0','','1479604511','111.194.244.137','0.00','0','111.194.244.137','1479604511');
DROP TABLE IF EXISTS jh_member_address;
CREATE TABLE `jh_member_address` (
  `addr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `addr` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 AUTO_INCREMENT=71;

DROP TABLE IF EXISTS jh_member_connect;
CREATE TABLE `jh_member_connect` (
  `connect_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `from` enum('qzone','weibo','alipay','taobao') DEFAULT 'qzone',
  `open_id` varchar(32) DEFAULT '0',
  `token` varchar(50) DEFAULT '',
  `uid` mediumint(8) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`connect_id`),
  UNIQUE KEY `type` (`from`,`open_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_member_favorite;
CREATE TABLE `jh_member_favorite` (
  `fav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `from` enum('case','shop','gz','designer','product','company') DEFAULT NULL,
  `itemId` int(10) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_member_fields;
CREATE TABLE `jh_member_fields` (
  `uid` int(10) NOT NULL DEFAULT '0',
  `addr` varchar(255) DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_member_fields VALUES ('2','');
INSERT INTO jh_member_fields VALUES ('1','');
INSERT INTO jh_member_fields VALUES ('3','');
INSERT INTO jh_member_fields VALUES ('4','');
INSERT INTO jh_member_fields VALUES ('5','');
INSERT INTO jh_member_fields VALUES ('6','');
INSERT INTO jh_member_fields VALUES ('7','');
INSERT INTO jh_member_fields VALUES ('8','');
INSERT INTO jh_member_fields VALUES ('9','');
INSERT INTO jh_member_fields VALUES ('10','');
INSERT INTO jh_member_fields VALUES ('11','');
INSERT INTO jh_member_fields VALUES ('12','');
INSERT INTO jh_member_fields VALUES ('13','');
INSERT INTO jh_member_fields VALUES ('14','');
INSERT INTO jh_member_fields VALUES ('15','');
INSERT INTO jh_member_fields VALUES ('16','');
INSERT INTO jh_member_fields VALUES ('17','');
INSERT INTO jh_member_fields VALUES ('18','');
INSERT INTO jh_member_fields VALUES ('19','');
INSERT INTO jh_member_fields VALUES ('20','');
INSERT INTO jh_member_fields VALUES ('21','');
INSERT INTO jh_member_fields VALUES ('22','');
INSERT INTO jh_member_fields VALUES ('23','');
INSERT INTO jh_member_fields VALUES ('24','');
INSERT INTO jh_member_fields VALUES ('25','');
INSERT INTO jh_member_fields VALUES ('26','');
INSERT INTO jh_member_fields VALUES ('27','');
INSERT INTO jh_member_fields VALUES ('28','');
INSERT INTO jh_member_fields VALUES ('29','');
INSERT INTO jh_member_fields VALUES ('30','');
INSERT INTO jh_member_fields VALUES ('31','');
INSERT INTO jh_member_fields VALUES ('32','');
INSERT INTO jh_member_fields VALUES ('33','');
INSERT INTO jh_member_fields VALUES ('34','');
INSERT INTO jh_member_fields VALUES ('35','');
INSERT INTO jh_member_fields VALUES ('36','');
INSERT INTO jh_member_fields VALUES ('37','');
INSERT INTO jh_member_fields VALUES ('38','');
INSERT INTO jh_member_fields VALUES ('39','');
INSERT INTO jh_member_fields VALUES ('40','');
INSERT INTO jh_member_fields VALUES ('41','');
INSERT INTO jh_member_fields VALUES ('42','');
INSERT INTO jh_member_fields VALUES ('43','');
INSERT INTO jh_member_fields VALUES ('44','');
INSERT INTO jh_member_fields VALUES ('45','');
INSERT INTO jh_member_fields VALUES ('46','');
INSERT INTO jh_member_fields VALUES ('47','');
INSERT INTO jh_member_fields VALUES ('48','');
INSERT INTO jh_member_fields VALUES ('49','');
INSERT INTO jh_member_fields VALUES ('50','');
INSERT INTO jh_member_fields VALUES ('51','');
INSERT INTO jh_member_fields VALUES ('52','');
INSERT INTO jh_member_fields VALUES ('53','');
INSERT INTO jh_member_fields VALUES ('54','');
INSERT INTO jh_member_fields VALUES ('55','');
INSERT INTO jh_member_fields VALUES ('56','');
INSERT INTO jh_member_fields VALUES ('57','');
INSERT INTO jh_member_fields VALUES ('58','');
INSERT INTO jh_member_fields VALUES ('59','');
INSERT INTO jh_member_fields VALUES ('60','');
INSERT INTO jh_member_fields VALUES ('61','');
INSERT INTO jh_member_fields VALUES ('62','');
INSERT INTO jh_member_fields VALUES ('63','');
INSERT INTO jh_member_fields VALUES ('64','');
INSERT INTO jh_member_fields VALUES ('65','');
INSERT INTO jh_member_fields VALUES ('66','');
INSERT INTO jh_member_fields VALUES ('67','');
INSERT INTO jh_member_fields VALUES ('68','');
INSERT INTO jh_member_fields VALUES ('69','');
INSERT INTO jh_member_fields VALUES ('70','');
INSERT INTO jh_member_fields VALUES ('71','');
INSERT INTO jh_member_fields VALUES ('72','');
INSERT INTO jh_member_fields VALUES ('73','');
INSERT INTO jh_member_fields VALUES ('74','');
INSERT INTO jh_member_fields VALUES ('75','');
INSERT INTO jh_member_fields VALUES ('76','');
INSERT INTO jh_member_fields VALUES ('77','');
INSERT INTO jh_member_fields VALUES ('78','');
INSERT INTO jh_member_fields VALUES ('79','');
INSERT INTO jh_member_fields VALUES ('80','');
INSERT INTO jh_member_fields VALUES ('81','');
INSERT INTO jh_member_fields VALUES ('82','');
INSERT INTO jh_member_fields VALUES ('83','');
INSERT INTO jh_member_fields VALUES ('84','');
INSERT INTO jh_member_fields VALUES ('85','');
INSERT INTO jh_member_fields VALUES ('86','');
INSERT INTO jh_member_fields VALUES ('87','');
INSERT INTO jh_member_fields VALUES ('88','');
INSERT INTO jh_member_fields VALUES ('89','');
INSERT INTO jh_member_fields VALUES ('90','');
INSERT INTO jh_member_fields VALUES ('91','');
INSERT INTO jh_member_fields VALUES ('92','');
INSERT INTO jh_member_fields VALUES ('93','');
INSERT INTO jh_member_fields VALUES ('94','');
INSERT INTO jh_member_fields VALUES ('95','');
INSERT INTO jh_member_fields VALUES ('96','');
INSERT INTO jh_member_fields VALUES ('97','');
INSERT INTO jh_member_fields VALUES ('98','');
INSERT INTO jh_member_fields VALUES ('99','');
INSERT INTO jh_member_fields VALUES ('100','');
INSERT INTO jh_member_fields VALUES ('101','');
INSERT INTO jh_member_fields VALUES ('102','');
INSERT INTO jh_member_fields VALUES ('103','');
INSERT INTO jh_member_fields VALUES ('104','');
INSERT INTO jh_member_fields VALUES ('105','');
INSERT INTO jh_member_fields VALUES ('106','');
INSERT INTO jh_member_fields VALUES ('107','');
INSERT INTO jh_member_fields VALUES ('108','');
INSERT INTO jh_member_fields VALUES ('109','');
INSERT INTO jh_member_fields VALUES ('110','');
INSERT INTO jh_member_fields VALUES ('111','');
INSERT INTO jh_member_fields VALUES ('112','');
INSERT INTO jh_member_fields VALUES ('113','');
INSERT INTO jh_member_fields VALUES ('114','');
INSERT INTO jh_member_fields VALUES ('115','');
INSERT INTO jh_member_fields VALUES ('116','');
INSERT INTO jh_member_fields VALUES ('117','');
INSERT INTO jh_member_fields VALUES ('118','');
INSERT INTO jh_member_fields VALUES ('119','');
INSERT INTO jh_member_fields VALUES ('120','');
INSERT INTO jh_member_fields VALUES ('121','');
INSERT INTO jh_member_fields VALUES ('122','');
INSERT INTO jh_member_fields VALUES ('123','');
INSERT INTO jh_member_fields VALUES ('124','');
INSERT INTO jh_member_fields VALUES ('125','');
INSERT INTO jh_member_fields VALUES ('126','');
INSERT INTO jh_member_fields VALUES ('127','');
INSERT INTO jh_member_fields VALUES ('128','');
INSERT INTO jh_member_fields VALUES ('129','');
INSERT INTO jh_member_fields VALUES ('130','');
INSERT INTO jh_member_fields VALUES ('131','');
INSERT INTO jh_member_fields VALUES ('132','');
INSERT INTO jh_member_fields VALUES ('133','');
INSERT INTO jh_member_fields VALUES ('134','');
INSERT INTO jh_member_fields VALUES ('135','');
INSERT INTO jh_member_fields VALUES ('136','');
INSERT INTO jh_member_fields VALUES ('137','');
INSERT INTO jh_member_fields VALUES ('138','');
INSERT INTO jh_member_fields VALUES ('139','');
INSERT INTO jh_member_fields VALUES ('140','');
INSERT INTO jh_member_fields VALUES ('141','');
INSERT INTO jh_member_fields VALUES ('142','');
INSERT INTO jh_member_fields VALUES ('143','');
INSERT INTO jh_member_fields VALUES ('144','');
INSERT INTO jh_member_fields VALUES ('145','');
INSERT INTO jh_member_fields VALUES ('146','');
INSERT INTO jh_member_fields VALUES ('147','');
INSERT INTO jh_member_fields VALUES ('148','');
INSERT INTO jh_member_fields VALUES ('270','');
DROP TABLE IF EXISTS jh_member_flush;
CREATE TABLE `jh_member_flush` (
  `flush_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `from` varchar(10) NOT NULL DEFAULT '',
  `itemId` int(10) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`flush_id`,`from`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 AUTO_INCREMENT=83;

DROP TABLE IF EXISTS jh_member_group;
CREATE TABLE `jh_member_group` (
  `group_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) DEFAULT '',
  `from` enum('member','mechanic','foreman','designer','company','shop','gz') DEFAULT 'member',
  `icon` varchar(150) DEFAULT '',
  `free_count` smallint(6) DEFAULT '0',
  `priv` mediumtext,
  `orderby` smallint(5) DEFAULT '50',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

INSERT INTO jh_member_group VALUES ('1','普通业主','member','21020','0','a:5:{s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";}','50');
INSERT INTO jh_member_group VALUES ('2','普通设计师','designer','22','0','a:15:{s:12:\"allow_access\";s:1:\"1\";s:13:\"allow_tenders\";s:1:\"1\";s:11:\"allow_order\";s:1:\"1\";s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:14:\"day_free_count\";s:1:\"5\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:10:\"show_phone\";s:1:\"1\";s:11:\"allow_yuyue\";s:1:\"1\";s:12:\"tenders_look\";s:1:\"1\";s:10:\"allow_case\";s:1:\"0\";s:10:\"allow_blog\";s:1:\"0\";}','50');
INSERT INTO jh_member_group VALUES ('4','普通安防智能公司','company','2','0','a:20:{s:12:\"allow_access\";s:1:\"1\";s:13:\"allow_tenders\";s:1:\"1\";s:11:\"allow_order\";s:1:\"1\";s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:14:\"day_free_count\";s:1:\"1\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:10:\"show_phone\";s:1:\"1\";s:11:\"allow_yuyue\";s:1:\"1\";s:12:\"tenders_look\";s:1:\"1\";s:10:\"allow_skin\";s:2:\"-1\";s:12:\"allow_banner\";s:1:\"1\";s:12:\"allow_domain\";s:1:\"1\";s:10:\"allow_case\";s:1:\"0\";s:10:\"allow_site\";s:1:\"0\";s:10:\"allow_news\";s:1:\"0\";s:12:\"allow_youhui\";s:1:\"0\";}','50');
INSERT INTO jh_member_group VALUES ('5','钻石安防智能公司','company','3','0','a:17:{s:12:\"allow_access\";s:2:\"-1\";s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:14:\"day_free_count\";s:1:\"1\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:10:\"show_phone\";s:1:\"0\";s:11:\"allow_yuyue\";s:1:\"1\";s:12:\"tenders_look\";s:1:\"1\";s:10:\"allow_case\";s:1:\"0\";s:10:\"allow_site\";s:1:\"0\";s:10:\"allow_news\";s:1:\"0\";s:12:\"allow_youhui\";s:1:\"0\";s:12:\"allow_weixin\";s:1:\"1\";s:11:\"allow_msite\";s:1:\"1\";}','50');
INSERT INTO jh_member_group VALUES ('6','普通工长','gz','11','0','a:15:{s:12:\"allow_access\";s:1:\"1\";s:13:\"allow_tenders\";s:1:\"1\";s:11:\"allow_order\";s:1:\"1\";s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:14:\"day_free_count\";s:1:\"0\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:11:\"allow_yuyue\";s:1:\"1\";s:10:\"show_phone\";s:1:\"1\";s:12:\"tenders_look\";s:1:\"1\";s:10:\"allow_case\";s:1:\"0\";s:10:\"allow_site\";s:1:\"0\";}','50');
INSERT INTO jh_member_group VALUES ('7','普通商家','shop','222','0','a:24:{s:12:\"allow_access\";s:1:\"1\";s:13:\"allow_tenders\";s:1:\"1\";s:11:\"allow_order\";s:1:\"1\";s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:12:\"allow_weixin\";s:1:\"1\";s:11:\"allow_msite\";s:1:\"1\";s:14:\"day_free_count\";s:1:\"1\";s:11:\"allow_reply\";s:1:\"1\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:10:\"show_phone\";s:1:\"1\";s:11:\"allow_yuyue\";s:1:\"1\";s:12:\"tenders_look\";s:1:\"1\";s:10:\"allow_skin\";s:1:\"1\";s:12:\"allow_banner\";s:2:\"-1\";s:12:\"allow_domain\";s:1:\"1\";s:13:\"allow_product\";s:1:\"0\";s:15:\"product_payment\";s:1:\"0\";s:12:\"allow_coupon\";s:1:\"0\";s:10:\"allow_news\";s:1:\"0\";s:13:\"allow_mendian\";s:1:\"1\";}','50');
INSERT INTO jh_member_group VALUES ('8','普通技工','mechanic','333','0','a:10:{s:9:\"allow_ask\";s:1:\"0\";s:12:\"allow_answer\";s:1:\"0\";s:11:\"allow_diary\";s:1:\"0\";s:11:\"allow_score\";s:1:\"0\";s:13:\"allow_comment\";s:1:\"0\";s:14:\"day_free_count\";s:1:\"1\";s:17:\"show_yuyue_mobile\";s:1:\"1\";s:10:\"show_phone\";s:2:\"-1\";s:11:\"allow_yuyue\";s:2:\"-1\";s:12:\"tenders_look\";s:2:\"-1\";}','50');
DROP TABLE IF EXISTS jh_member_group_copy;
CREATE TABLE `jh_member_group_copy` (
  `group_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) DEFAULT '',
  `from` enum('member','mechanic','foreman','designer','company','shop','gz') DEFAULT 'member',
  `icon` varchar(150) DEFAULT '',
  `free_count` smallint(6) DEFAULT '0',
  `priv` mediumtext,
  `orderby` smallint(5) DEFAULT '50',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_member_log;
CREATE TABLE `jh_member_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `from` enum('credits','gold','truste','money') DEFAULT NULL,
  `action` varchar(10) DEFAULT '',
  `number` smallint(6) DEFAULT '0',
  `log` varchar(255) DEFAULT '',
  `admin` varchar(255) DEFAULT '',
  `clientip` char(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=485 DEFAULT CHARSET=utf8 AUTO_INCREMENT=485;

DROP TABLE IF EXISTS jh_member_packet;
CREATE TABLE `jh_member_packet` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `uid` mediumint(8) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `cate_id` mediumint(6) DEFAULT '0',
  `shop_id` mediumint(8) DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `man` mediumint(8) DEFAULT NULL,
  `time` int(5) DEFAULT NULL,
  `last_time` int(10) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `ltime` int(10) NOT NULL,
  `is_use` tinyint(1) NOT NULL DEFAULT '0',
  `desc` text,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=344 DEFAULT CHARSET=utf8 AUTO_INCREMENT=344;

DROP TABLE IF EXISTS jh_member_verify;
CREATE TABLE `jh_member_verify` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `id_number` varchar(50) DEFAULT '',
  `id_photo` varchar(150) DEFAULT '',
  `mobile` varchar(50) DEFAULT NULL,
  `verify` tinyint(1) DEFAULT '0',
  `refuse` varchar(255) DEFAULT '',
  `verify_time` int(10) DEFAULT '0',
  `request_ip` varchar(15) DEFAULT '0.0.0.0',
  `request_time` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_member_weixin;
CREATE TABLE `jh_member_weixin` (
  `uid` mediumint(8) DEFAULT '0',
  `openid` char(50) DEFAULT '',
  `unionid` char(50) DEFAULT '',
  `info` mediumtext,
  `status` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_order;
CREATE TABLE `jh_order` (
  `order_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` mediumint(8) DEFAULT '0',
  `city_id` mediumint(8) DEFAULT NULL,
  `product_count` mediumint(8) DEFAULT '0',
  `product_number` mediumint(8) DEFAULT '0',
  `product_amount` decimal(10,2) DEFAULT '0.00',
  `freight` decimal(6,2) DEFAULT '0.00',
  `amount` decimal(10,2) DEFAULT '0.00',
  `contact` varchar(50) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `addr` varchar(200) DEFAULT '',
  `note` varchar(255) DEFAULT '',
  `pay_status` tinyint(1) DEFAULT '0',
  `pay_time` int(10) DEFAULT '0',
  `order_status` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  `project_id` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8 AUTO_INCREMENT=170;

DROP TABLE IF EXISTS jh_order_product;
CREATE TABLE `jh_order_product` (
  `order_pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) DEFAULT '0',
  `product_id` int(10) DEFAULT '0',
  `product_name` varchar(100) DEFAULT '',
  `spec_id` int(10) DEFAULT '0',
  `spec_name` varchar(50) DEFAULT '',
  `product_price` decimal(10,2) DEFAULT '0.00',
  `number` smallint(6) DEFAULT '0',
  `freight` decimal(6,2) DEFAULT '0.00',
  `amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`order_pid`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 AUTO_INCREMENT=195;

DROP TABLE IF EXISTS jh_packet;
CREATE TABLE `jh_packet` (
  `packet_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `cate_id` mediumint(6) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `man` mediumint(6) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `last_time` int(10) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `shop_id` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`packet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

DROP TABLE IF EXISTS jh_payment;
CREATE TABLE `jh_payment` (
  `payment_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `payment` varchar(20) DEFAULT '',
  `title` varchar(100) DEFAULT '',
  `logo` varchar(150) DEFAULT '',
  `config` mediumtext,
  `status` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_payment_log;
CREATE TABLE `jh_payment_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` mediumint(8) DEFAULT '0',
  `from` enum('order','truste','gold') DEFAULT NULL,
  `truste_id` mediumint(8) DEFAULT NULL,
  `payment` varchar(20) DEFAULT '',
  `trade_no` int(10) DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `packet` mediumint(10) DEFAULT NULL,
  `payed` tinyint(1) DEFAULT '0',
  `payedip` varchar(15) DEFAULT '',
  `payedtime` int(10) DEFAULT '0',
  `pay_trade_no` varchar(50) DEFAULT '',
  `extra_pay` varchar(200) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `trade_no` (`trade_no`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 AUTO_INCREMENT=245;

DROP TABLE IF EXISTS jh_pm_site;
CREATE TABLE `jh_pm_site` (
  `site_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `zxpm_id` int(10) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT NULL,
  `addr` varchar(255) DEFAULT '',
  `home_name` varchar(100) DEFAULT '',
  `house_mj` smallint(6) DEFAULT '0',
  `custom` varchar(255) DEFAULT '0',
  `custom_id` int(11) DEFAULT NULL,
  `company_id` int(10) DEFAULT '0',
  `company` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `closed` tinyint(1) DEFAULT '0',
  `starttime` int(10) DEFAULT '0',
  `endtime` int(11) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

DROP TABLE IF EXISTS jh_pm_site_progress;
CREATE TABLE `jh_pm_site_progress` (
  `progress_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) DEFAULT '0',
  `company_id` int(10) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `status` tinyint(1) unsigned DEFAULT '0',
  `attach` varchar(255) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`progress_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

DROP TABLE IF EXISTS jh_price_attr;
CREATE TABLE `jh_price_attr` (
  `priceattr_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `pricefrom_id` smallint(6) DEFAULT NULL,
  `order` smallint(6) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT NULL,
  `zhucai` decimal(10,2) DEFAULT NULL,
  `fucai` decimal(10,2) DEFAULT NULL,
  `rengong` decimal(10,2) DEFAULT '0.00',
  `content` varchar(255) DEFAULT NULL,
  `per` varchar(10) DEFAULT '0.00',
  PRIMARY KEY (`priceattr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18;

INSERT INTO jh_price_attr VALUES ('2','地面找平（≤30mm）-适用于地砖干铺','4','50','7','0.88','12.00','12.00','水泥砂浆（1：3）找平，海螺水泥（225）（≤30mm，厚度每增加10mm增加15元/㎡）；材料损耗率：无损耗','100%');
INSERT INTO jh_price_attr VALUES ('3','地面找平（≤30mm）-适用于复合地板','4','50','7','12.00','12.00','12.00','水泥砂浆（1：2）找平，水泥砂浆（1：1）粉光，海螺水泥（225）（≤30mm，厚度每增加10mm增加15元/㎡）；材料损耗率：无损耗','100%');
INSERT INTO jh_price_attr VALUES ('4','地面做二遍防水处理','4','50','7','12.00','12.00','12.00','东方雨虹（101-B）柔性防水灰浆（淋浴房墙裙高1800mm，其他区域300mm）；材料损耗率：无损耗','100%');
INSERT INTO jh_price_attr VALUES ('5','铺贴地砖不拼花（含填缝，单边≥200mm）','4','50','7','12.00','12.00','12.00','瓷砖铺贴的辅材及人工（瓷砖见主材清单），海螺水泥、填缝剂、建筑胶水；材料损耗率：0.05','100.00%');
INSERT INTO jh_price_attr VALUES ('6','大理石门槛（深色，总宽度≤300mm）','4','50','7','12.00','12.00','12.00','大理石门槛的材料和人工（蒙古黑，新萨娜米黄二选一）（≤2m）；材料损耗率：无损耗','200.00%');
INSERT INTO jh_price_attr VALUES ('7','墙面批腻子','5','50','7','0.99','12.00','12.00','批两遍腻子，人工打磨（壁丽宝滑石粉，中南牌建筑胶水无甲醛）；材料损耗率：无损耗','1');
INSERT INTO jh_price_attr VALUES ('11','墙面滚胶','5','50','7','2.00','0.00','4.00','<span style=\"color:#666666;font-family:arial;font-size:14px;line-height:24px;background-color:#FFFFFF;\">中南牌建筑胶水无甲醛（适用原墙已有批嵌找平）；材料损耗率：无损耗</span>','45.5%');
INSERT INTO jh_price_attr VALUES ('13','吊顶开灯孔','6','50','7','2.00','12.00','4.00','<span style=\"color:#666666;font-family:arial;font-size:14px;line-height:24px;background-color:#FFFFFF;\">辅材人工；材料损耗率：无损耗</span>','80%');
INSERT INTO jh_price_attr VALUES ('14','墙面表面处理','5','0','7','2.00','12.00','4.00','<span style=\"color:#666666;font-family:arial;font-size:14px;line-height:24px;background-color:#FFFFFF;\">铲除涂料层（铲到红砖另计）；材料损耗率：无损耗</span>','45%');
INSERT INTO jh_price_attr VALUES ('16','管线开槽（砖墙，含修粉）','5','50','7','2134.00','234.00','34.00','<span style=\"color:#666666;font-family:arial;font-size:14px;line-height:24px;background-color:#FFFFFF;\">砖墙（按实际发生工程量计算）（同槽内每m每增加一根管时则实际工程量增加0.5m）；材料损耗率：无损耗</span>','213%');
DROP TABLE IF EXISTS jh_price_attr_from;
CREATE TABLE `jh_price_attr_from` (
  `pricefrom_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pricefrom` varchar(30) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`pricefrom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

INSERT INTO jh_price_attr_from VALUES ('6','顶面','顶面','7');
INSERT INTO jh_price_attr_from VALUES ('5','墙面','墙面','7');
INSERT INTO jh_price_attr_from VALUES ('4','地面','地面','7');
INSERT INTO jh_price_attr_from VALUES ('7','门窗','门窗','7');
DROP TABLE IF EXISTS jh_product;
CREATE TABLE `jh_product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `shop_id` mediumint(8) DEFAULT '0',
  `cat_id` smallint(6) DEFAULT '0',
  `vcat_id` mediumint(8) DEFAULT '0',
  `brand_id` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `danwei` varchar(20) DEFAULT '',
  `market_price` decimal(10,2) DEFAULT '0.00',
  `price` decimal(10,2) DEFAULT '0.00',
  `freight` decimal(8,0) DEFAULT '0',
  `photo` varchar(150) DEFAULT '',
  `photos` smallint(6) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `score` mediumint(8) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `books` mediumint(8) DEFAULT '0',
  `store` mediumint(8) DEFAULT NULL,
  `buys` mediumint(8) DEFAULT '0',
  `onsale` enum('Y','N') DEFAULT 'Y',
  `onpayment` tinyint(1) DEFAULT '0',
  `sale_type` tinyint(1) DEFAULT '0',
  `sale_time` int(10) DEFAULT '0',
  `sale_sku` mediumint(8) DEFAULT '0',
  `sale_count` mediumint(8) DEFAULT '0',
  `sale_remai` tinyint(1) DEFAULT '0',
  `sale_youhui` tinyint(1) DEFAULT '0',
  `sale_tuijian` tinyint(1) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `lastupdate` int(10) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `shop_id` (`shop_id`,`orderby`,`audit`,`closed`,`onsale`,`sale_type`,`sale_remai`,`sale_youhui`,`sale_tuijian`),
  KEY `price` (`vcat_id`,`brand_id`,`city_id`,`area_id`,`price`,`orderby`,`audit`,`closed`,`onsale`),
  KEY `views` (`vcat_id`,`brand_id`,`city_id`,`area_id`,`freight`,`views`,`orderby`,`audit`,`closed`),
  KEY `buys` (`vcat_id`,`brand_id`,`city_id`,`area_id`,`score`,`buys`,`orderby`,`audit`,`closed`,`onsale`,`books`),
  KEY `sale` (`onsale`,`sale_type`,`sale_remai`,`sale_youhui`,`sale_tuijian`,`onpayment`)
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=utf8 AUTO_INCREMENT=235;

INSERT INTO jh_product VALUES ('1','尊享法式高端家具 奢华真皮布艺结合沙发 沙发套装（1+2+3+6腰枕）','尊享法式高端家具 奢华真皮布艺结合沙发 沙发套装（1+2+3+6腰枕）','4','2','1','0','7','0','平方米','22600.00','22600.00','0','demo/product/201502/20150214_D521621D1995B0C1212420B12D079CDF.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884798','1423884798');
INSERT INTO jh_product VALUES ('2','SUS304不锈钢防臭地漏','SUS304不锈钢防臭地漏','9','3','1','0','7','0','平方米','23.00','23.00','0','demo/product/201502/20150214_FF1457500CD6B44B4926ADEA25812D75.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884798','1423884798');
INSERT INTO jh_product VALUES ('3','高靠背亚克力浴缸 独立式浴缸 椭圆形单人浴缸','高靠背亚克力浴缸 独立式浴缸 椭圆形单人浴缸','17','2','1','0','7','0','平方米','1998.00','1998.00','0','demo/product/201502/20150214_7D989CBDF2FE4FA51E221A569E195A79.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884798','1423884798');
INSERT INTO jh_product VALUES ('4','圆角三层架挂件 不锈钢卫浴挂件','圆角三层架挂件 不锈钢卫浴挂件','5','1','1','0','7','0','平方米','132.00','132.00','0','demo/product/201502/20150214_A4F87C1F996666485E5A6DA3B2FB0A85.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884799','1423884799');
INSERT INTO jh_product VALUES ('5','卧室1.8米床3套装','卧室1.8米床3套装','7','1','1','0','7','0','平方米','8890.00','8890.00','0','demo/product/201502/20150214_38B7608C1531B1952E144E5741963C3D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884799','1423884799');
INSERT INTO jh_product VALUES ('6','布艺餐椅 无扶手餐椅','布艺餐椅 无扶手餐椅','4','3','1','0','7','0','平方米','1180.00','1180.00','0','demo/product/201502/20150214_73357D4815BBC3EA2AE32415FAFB708B.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884799','1423884799');
INSERT INTO jh_product VALUES ('7','户外罗马伞 岗亭伞 遮阳伞  铝合金伞','户外罗马伞 岗亭伞 遮阳伞  铝合金伞','15','1','1','0','7','0','平方米','1480.00','1480.00','0','demo/product/201502/20150214_B30F9016EA23678A23F7689717B8499B.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884800','1423884800');
INSERT INTO jh_product VALUES ('8','全实木沙发客厅5件套（1+2+3+茶几+电视柜）','全实木沙发客厅5件套（1+2+3+茶几+电视柜）','12','3','1','0','7','0','平方米','12080.00','12080.00','0','demo/product/201502/20150214_C39AB6AFF476E038E9ECD1D844337B1A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884800','1423884800');
INSERT INTO jh_product VALUES ('9','典雅大气 纯手工雕花 顶级美国进口黄杨实木电视柜','典雅大气 纯手工雕花 顶级美国进口黄杨实木电视柜','13','1','1','0','7','0','平方米','4600.00','4600.00','0','demo/product/201502/20150214_1B595D641742D1FF1166A299D77CCD49.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884800','1423884800');
INSERT INTO jh_product VALUES ('10','儒雅典范 唯美浪漫雕花 华贵耐磨雪尼尔布艺沙发套装（1+2+3）','儒雅典范 唯美浪漫雕花 华贵耐磨雪尼尔布艺沙发套装（1+2+3）','12','2','1','0','7','0','平方米','15600.00','15600.00','0','demo/product/201502/20150214_7232FB99171479ADCFF16134E237F8FF.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884801','1423884801');
INSERT INTO jh_product VALUES ('11','1.2米实木床 双层儿童床 板条床','1.2米实木床 双层儿童床 板条床','4','1','1','0','7','0','平方米','4586.00','4586.00','0','demo/product/201502/20150214_4AF78CBA1796D0B4FBA674C6121A0D94.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884801','1423884801');
INSERT INTO jh_product VALUES ('12','圆形陶瓷洗手盆 台上式洗脸盆 台盆','圆形陶瓷洗手盆 台上式洗脸盆 台盆','1','1','1','0','7','0','平方米','149.00','149.00','0','demo/product/201502/20150214_3B43FB4CD617D358E36AAF31FA769224.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884801','1423884801');
INSERT INTO jh_product VALUES ('13','皮艺客厅家具5件套（1+2+3+茶几+角几）','皮艺客厅家具5件套（1+2+3+茶几+角几）','11','4','1','0','7','0','平方米','25509.00','25509.00','0','demo/product/201502/20150214_7FEDBE846CAA976DE7CF9A483625B85A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884801','1423884801');
INSERT INTO jh_product VALUES ('14','白色家具田园双门酒柜','白色家具田园双门酒柜','16','2','1','0','7','0','平方米','2253.00','2253.00','0','demo/product/201502/20150214_94F5ED8F5D68E14092B07BFBF6505FC3.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884802','1423884802');
INSERT INTO jh_product VALUES ('15','超豪华1.93米双人床 黄牛双色头层真皮床 高端古典床','超豪华1.93米双人床 黄牛双色头层真皮床 高端古典床','13','1','1','0','7','0','平方米','12999.00','12999.00','0','demo/product/201502/20150214_3F19A351724A28F88879BA9E279A8794.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884802','1423884802');
INSERT INTO jh_product VALUES ('16','卧室套装（1.5米床+1床头柜+1床垫）','卧室套装（1.5米床+1床头柜+1床垫）','1','1','1','0','7','0','平方米','8999.00','8999.00','0','demo/product/201502/20150214_AAF4968C7377B14AC3DC2A1EFC4B4638.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884802','1423884802');
INSERT INTO jh_product VALUES ('17','欧美 天使的翅膀8头吊灯 吊吸两用 客厅餐厅吊灯','欧美 天使的翅膀8头吊灯 吊吸两用 客厅餐厅吊灯','14','1','1','0','7','0','平方米','1788.00','1788.00','0','demo/product/201502/20150214_CC90F66C184F934213B62443B0E8B048.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884802','1423884802');
INSERT INTO jh_product VALUES ('18','多功能电脑台书柜组合','多功能电脑台书柜组合','17','4','1','0','7','0','平方米','2060.00','2060.00','0','demo/product/201502/20150214_5F9858B95FFABA0B7D65362106C26453.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884803','1423884803');
INSERT INTO jh_product VALUES ('19','【美姿·朝霞】1.53米SRX钛合金弹簧床垫 健康环保床垫','【美姿·朝霞】1.53米SRX钛合金弹簧床垫 健康环保床垫','8','1','1','0','7','0','平方米','4999.00','4999.00','0','demo/product/201502/20150214_E7972AE8377CDDAF11C74737E20BEC92.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884803','1423884803');
INSERT INTO jh_product VALUES ('20','经典传承  进口桦木复古款1.6米长餐台','经典传承  进口桦木复古款1.6米长餐台','8','1','1','0','7','0','平方米','3578.00','3578.00','0','demo/product/201502/20150214_2A94472405B464B479045F252CFEDAB3.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884803','1423884803');
INSERT INTO jh_product VALUES ('21','品牌法式家具-卧室华美1.93米加大双人床 豪华实木床','品牌法式家具-卧室华美1.93米加大双人床 豪华实木床','12','3','1','0','7','0','平方米','10500.00','10500.00','0','demo/product/201502/20150214_4EDDE4B89A6E79821098D6854A901B2F.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884804','1423884804');
INSERT INTO jh_product VALUES ('22','家用环保强化地板12mm','家用环保强化地板12mm','1','2','1','0','7','0','平方米','69.00','69.00','0','demo/product/201502/20150214_81A3F5962B085FD2C711576AB7E4BB42.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884804','1423884804');
INSERT INTO jh_product VALUES ('23','白色四门衣柜 雕花衣柜 板式衣柜','白色四门衣柜 雕花衣柜 板式衣柜','4','1','1','0','7','0','平方米','5382.00','5382.00','0','demo/product/201502/20150214_0135A3F1262ECF959C18284A093CF26F.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884804','1423884804');
INSERT INTO jh_product VALUES ('24','典雅精致书房家具 荷花白实用书桌','典雅精致书房家具 荷花白实用书桌','1','3','1','0','7','0','平方米','3160.00','3160.00','0','demo/product/201502/20150214_955E75545B8DE57890C0610A54B91C1F.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884805','1423884805');
INSERT INTO jh_product VALUES ('25','全铜纯白8寸大顶喷时尚升降花洒套装','全铜纯白8寸大顶喷时尚升降花洒套装','10','4','1','0','7','0','平方米','428.00','428.00','0','demo/product/201502/20150214_FC97D3152DE797C1DD19B09F4A303ADD.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884805','1423884805');
INSERT INTO jh_product VALUES ('26','3W球泡灯（暖白光） E27灯泡','3W球泡灯（暖白光） E27灯泡','12','4','1','0','7','0','平方米','11.00','11.00','0','demo/product/201502/20150214_BD3B0C8B5CDA12C0FFC950926F6CD82A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884806','1423884806');
INSERT INTO jh_product VALUES ('27','高贵典雅的四门衣柜 板式衣柜','高贵典雅的四门衣柜 板式衣柜','10','3','1','0','7','0','平方米','7200.00','7200.00','0','demo/product/201502/20150214_2C20E24D67400E7E6D3D760661CB92E9.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884806','1423884806');
INSERT INTO jh_product VALUES ('28','埃菲尔多彩陶瓷沙发垫','埃菲尔多彩陶瓷沙发垫','15','1','1','0','7','0','平方米','750.00','750.00','0','demo/product/201502/20150214_7BC10B02ACAC3A802416F154C3227329.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884806','1423884806');
INSERT INTO jh_product VALUES ('29','简约蓝色儿童床 进口实木床 1.2米床板条床','简约蓝色儿童床 进口实木床 1.2米床板条床','9','4','1','0','7','0','平方米','2160.00','2160.00','0','demo/product/201502/20150214_FAB0A41AB6174E84EE85EEEC523F7DD1.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884807','1423884807');
INSERT INTO jh_product VALUES ('30','欧式奢华提花高档定制客厅卧室半遮光窗帘 素雅灰','欧式奢华提花高档定制客厅卧室半遮光窗帘 素雅灰','17','4','1','0','7','0','平方米','198.00','198.00','0','demo/product/201502/20150214_235FDFB1379B4B098125548A7411AF8B.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884807','1423884807');
INSERT INTO jh_product VALUES ('31','实木可折叠蝴蝶餐桌','实木可折叠蝴蝶餐桌','9','3','1','0','7','0','平方米','2499.00','2499.00','0','demo/product/201502/20150214_CAE04D2B4399D3B9A4B4A37ED1DE0D2D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884807','1423884807');
INSERT INTO jh_product VALUES ('32','现代 3W暖白光 尖尾蜡烛灯 E14灯泡','现代 3W暖白光 尖尾蜡烛灯 E14灯泡','9','3','1','0','7','0','平方米','12.00','12.00','0','demo/product/201502/20150214_85A6722E4DEF68E2DF905E7ADF0D9EC4.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884808','1423884808');
INSERT INTO jh_product VALUES ('33','高档欧式风格全遮光双面提花布料成品卧室客厅窗帘M133 浅咖色','高档欧式风格全遮光双面提花布料成品卧室客厅窗帘M133 浅咖色','16','3','1','0','7','0','平方米','105.00','105.00','0','demo/product/201502/20150214_E7C3115EA144D42650D0336713CA5E0A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884808','1423884808');
INSERT INTO jh_product VALUES ('34','Amy艾美 1.8米床垫 3D椰棕床垫 弹簧床垫','Amy艾美 1.8米床垫 3D椰棕床垫 弹簧床垫','4','3','1','0','7','0','平方米','2299.00','2299.00','0','demo/product/201502/20150214_0F33707AA4E203C8D5D176B8C3BE775D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884809','1423884809');
INSERT INTO jh_product VALUES ('35','迷城系列沙发垫 80*80（一人位）','迷城系列沙发垫 80*80（一人位）','6','3','1','0','7','0','平方米','118.00','118.00','0','demo/product/201502/20150214_52AD76E47580DC3CD3CAD3D70BCA5942.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884809','1423884809');
INSERT INTO jh_product VALUES ('36','时尚陶瓷立柱洗脸盆 白色立柱盆 美观大方洗脸盆','时尚陶瓷立柱洗脸盆 白色立柱盆 美观大方洗脸盆','15','1','1','0','7','0','平方米','175.00','175.00','0','demo/product/201502/20150214_260BD0982FE9C6997DDA328B73DD220E.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884810','1423884810');
INSERT INTO jh_product VALUES ('37','幸福一生套巾（2毛巾+1浴巾）（蓝色）','幸福一生套巾（2毛巾+1浴巾）（蓝色）','7','4','1','0','7','0','平方米','66.00','66.00','0','demo/product/201502/20150214_34E34DEC67712A6F795CF9A9FFCEC52D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884810','1423884810');
INSERT INTO jh_product VALUES ('38','实木框架餐椅 简洁大方餐椅 浪漫温馨餐厅家具','实木框架餐椅 简洁大方餐椅 浪漫温馨餐厅家具','4','3','1','0','7','0','平方米','599.00','599.00','0','demo/product/201502/20150214_F883A78055549B01802C2F18CBA79EC6.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884810','1423884810');
INSERT INTO jh_product VALUES ('39','欧式高档黄咖色镂空窗纱加厚全遮光布窗帘 黄咖色','欧式高档黄咖色镂空窗纱加厚全遮光布窗帘 黄咖色','1','2','1','0','7','0','平方米','148.00','148.00','0','demo/product/201502/20150214_2065BF329FB8FECF378E725DCAF856C3.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884811','1423884811');
INSERT INTO jh_product VALUES ('40','手工雕花单门酒柜 玻璃柜门典雅酒柜 进口系列酒柜','手工雕花单门酒柜 玻璃柜门典雅酒柜 进口系列酒柜','10','1','1','0','7','0','平方米','2580.00','2580.00','0','demo/product/201502/20150214_F954BCCD8D3CDEB034B7E48E06E235D8.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884811','1423884811');
INSERT INTO jh_product VALUES ('41','塞纳舞曲系列 桌布  餐桌布 高档桌布 多功能盖巾盖布  110*160cm','塞纳舞曲系列 桌布  餐桌布 高档桌布 多功能盖巾盖布  110*160cm','10','2','1','0','7','0','平方米','138.00','138.00','0','demo/product/201502/20150214_B0B0528AFEA7DC3FEF759A075701EE0D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884811','1423884811');
INSERT INTO jh_product VALUES ('42','欧美 纯手工彩绘旗舰6头吊灯 皇室风格 客厅餐厅卧室','欧美 纯手工彩绘旗舰6头吊灯 皇室风格 客厅餐厅卧室','5','3','1','0','7','0','平方米','1560.00','1560.00','0','demo/product/201502/20150214_0F72BD09E7648F7D4CC0165FCD86768C.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884812','1423884812');
INSERT INTO jh_product VALUES ('43','涤棉物理遮光窗帘定制 巴黎野玫瑰','涤棉物理遮光窗帘定制 巴黎野玫瑰','10','3','1','0','7','0','平方米','54.00','54.00','0','demo/product/201502/20150214_E4C16090BF309BF168B5B47CF8CD8BAE.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884813','1423884813');
INSERT INTO jh_product VALUES ('44','涤棉遮光窗帘定制八色可选 宝蓝','涤棉遮光窗帘定制八色可选 宝蓝','3','2','1','0','7','0','平方米','43.00','43.00','0','demo/product/201502/20150214_0BF5C5AA6EE1546B0E01638D5A165DD9.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884813','1423884813');
INSERT INTO jh_product VALUES ('45','粉色长颈鹿三套装','粉色长颈鹿三套装','17','2','1','0','7','0','平方米','108.00','108.00','0','demo/product/201502/20150214_A6CF0F89B1D51B3F132AA27E2F1165BB.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884813','1423884813');
INSERT INTO jh_product VALUES ('46','品牌欧式绣花窗帘 落地帘 别墅酒店高档客厅定制弗罗拉','品牌欧式绣花窗帘 落地帘 别墅酒店高档客厅定制弗罗拉','5','4','1','0','7','0','平方米','216.00','216.00','0','demo/product/201502/20150214_61F2FEE195F52B930F2B858DACC74601.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884814','1423884814');
INSERT INTO jh_product VALUES ('47','高档布艺 纯棉窗帘定制 红蓝条格','高档布艺 纯棉窗帘定制 红蓝条格','11','2','1','0','7','0','平方米','45.00','45.00','0','demo/product/201502/20150214_0E102AD5430A032761D2F3CFE009A62E.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884816','1423884816');
INSERT INTO jh_product VALUES ('48','美罗客厅卧室地毯 客厅地毯 （多尺寸可选）香槟','美罗客厅卧室地毯 客厅地毯 （多尺寸可选）香槟','5','3','1','0','7','0','平方米','348.00','348.00','0','demo/product/201502/20150214_F73CB7248C113F500414D87D7ADF3A70.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884816','1423884816');
INSERT INTO jh_product VALUES ('49','净水器J1330-UF60T家用自来水龙头净水器直饮厨房台面净化直饮机','净水器J1330-UF60T家用自来水龙头净水器直饮厨房台面净化直饮机','7','2','1','0','7','0','平方米','388.00','388.00','0','demo/product/201502/20150214_A9F1309C4BC7FDD5C42A1C2A55003570.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884816','1423884816');
INSERT INTO jh_product VALUES ('50','醉恋巴比伦系列沙发套  沙发蒙  沙发巾  沙发罩  190*210cm','醉恋巴比伦系列沙发套  沙发蒙  沙发巾  沙发罩  190*210cm','4','3','1','0','7','0','平方米','448.00','448.00','0','demo/product/201502/20150214_44C55CF90EE468061E000F9CC832F2B2.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884817','1423884817');
INSERT INTO jh_product VALUES ('51','卢浮漫金 欧式宫廷款 高档丝绒烫金布艺 椅垫','卢浮漫金 欧式宫廷款 高档丝绒烫金布艺 椅垫','16','3','1','0','7','0','平方米','40.00','40.00','0','demo/product/201502/20150214_96F06F5606856119261E5237F68102EF.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884817','1423884817');
INSERT INTO jh_product VALUES ('52','4710+4905+3613侧吸式抽油烟机灶具消毒柜套装 烟灶消三件套装','4710+4905+3613侧吸式抽油烟机灶具消毒柜套装 烟灶消三件套装','16','3','1','0','7','0','平方米','2799.00','2799.00','0','demo/product/201502/20150214_9F58C8ADB37173595A7F757EDEF85FEF.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884817','1423884817');
INSERT INTO jh_product VALUES ('53','美佳剪花立体地毯 客厅地毯（多尺寸可选）05Y','美佳剪花立体地毯 客厅地毯（多尺寸可选）05Y','16','2','1','0','7','0','平方米','249.00','249.00','0','demo/product/201502/20150214_7A340992238D5C6D1AF91CF86DFF6418.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884818','1423884818');
INSERT INTO jh_product VALUES ('54','4703+4905机灶具套装 侧吸式油烟机燃气灶套餐','4703+4905机灶具套装 侧吸式油烟机燃气灶套餐','15','3','1','0','7','0','平方米','1888.00','1888.00','0','demo/product/201502/20150214_634ADC4CC9895EA57E55DA3968287541.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884818','1423884818');
INSERT INTO jh_product VALUES ('55','蓝色方格毛巾被','蓝色方格毛巾被','9','3','1','0','7','0','平方米','88.00','88.00','0','demo/product/201502/20150214_545229107174BE71CC4F454B2A0C1919.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884818','1423884818');
INSERT INTO jh_product VALUES ('56','XQS70-Z1216A 7公斤双动力全自动波轮洗衣机','XQS70-Z1216A 7公斤双动力全自动波轮洗衣机','17','4','1','0','7','0','平方米','2149.00','2149.00','0','demo/product/201502/20150214_5623406E169F11E1839FA7FC2F9D867C.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884819','1423884819');
INSERT INTO jh_product VALUES ('57','高档简约纯棉窗帘定制 挪威森林','高档简约纯棉窗帘定制 挪威森林','6','3','1','0','7','0','平方米','45.00','45.00','0','demo/product/201502/20150214_E417A2E106315465BDFC36FCD4281F5A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884819','1423884819');
INSERT INTO jh_product VALUES ('58','涤棉窗帘定制 地中海风 蓝白咖','涤棉窗帘定制 地中海风 蓝白咖','14','1','1','0','7','0','平方米','126.00','126.00','0','demo/product/201502/20150214_E70BB075CB2B9238537157D1D6E53BB4.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884820','1423884820');
INSERT INTO jh_product VALUES ('59','SAMSUNG SFN-ZX88RDB电子式遥控电风扇落地扇 机械臂 摇头扇','SAMSUNG SFN-ZX88RDB电子式遥控电风扇落地扇 机械臂 摇头扇','15','4','1','0','7','0','平方米','498.00','498.00','0','demo/product/201502/20150214_84092B8C51EF535D0537E8EC546AC587.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884820','1423884820');
INSERT INTO jh_product VALUES ('60','高档仿麻窗纱 成品定制 白色方格','高档仿麻窗纱 成品定制 白色方格','15','3','1','0','7','0','平方米','25.00','25.00','0','demo/product/201502/20150214_2A5ADAEEB15D24EEED38422883BE6F3C.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884820','1423884820');
INSERT INTO jh_product VALUES ('61','高档半遮光窗帘定制 速写英伦','高档半遮光窗帘定制 速写英伦','15','4','1','0','7','0','平方米','84.00','84.00','0','demo/product/201502/20150214_A8DCDCE8735C4B14610AC9A8B2E2E720.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884821','1423884821');
INSERT INTO jh_product VALUES ('62','SAMSUNG SFN-ZX88MDB超静音落地电风扇 定时摇头 落地扇','SAMSUNG SFN-ZX88MDB超静音落地电风扇 定时摇头 落地扇','11','3','1','0','7','0','平方米','318.00','318.00','0','demo/product/201502/20150214_7A926E942390A9DCDDE365AFDD24B640.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884821','1423884821');
INSERT INTO jh_product VALUES ('63','土黄色熊','土黄色熊','10','1','1','0','7','0','平方米','108.00','108.00','0','demo/product/201502/20150214_B0244DC3CE52059F82D618351F5E1112.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884822','1423884822');
INSERT INTO jh_product VALUES ('64','神奇无痕粘贴式马桶垫 7套装','神奇无痕粘贴式马桶垫 7套装','17','4','1','0','7','0','平方米','55.00','55.00','0','demo/product/201502/20150214_77A57E657764150CBC963B55F98FC5BB.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884822','1423884822');
INSERT INTO jh_product VALUES ('65','3135跑步机 多功能静音折叠跑步机 健身器材 【全国联保】','3135跑步机 多功能静音折叠跑步机 健身器材 【全国联保】','4','3','1','0','7','0','平方米','2888.00','2888.00','0','demo/product/201502/20150214_5C6E8DDEFE247B23FFFCE52DCAC6CEB0.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884822','1423884822');
INSERT INTO jh_product VALUES ('66','800纬剪花地毯 卧室地毯 客厅地毯 2*2.8米','800纬剪花地毯 卧室地毯 客厅地毯 2*2.8米','4','1','1','0','7','0','平方米','1206.00','1206.00','0','demo/product/201502/20150214_85730EEBDA1F666006E33378DCA36CE0.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884823','1423884823');
INSERT INTO jh_product VALUES ('67','外贸单全棉双股纱波浪浴巾2条装（粉色）','外贸单全棉双股纱波浪浴巾2条装（粉色）','5','2','1','0','7','0','平方米','139.00','139.00','0','demo/product/201502/20150214_5AAA9F25B82C472DF06F1B57D474C9EB.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884823','1423884823');
INSERT INTO jh_product VALUES ('68','BCD-579WE 579容升定频风冷对开门冰箱 白色（水韵纹）1级能效','BCD-579WE 579容升定频风冷对开门冰箱 白色（水韵纹）1级能效','13','4','1','0','7','0','平方米','4699.00','4699.00','0','demo/product/201502/20150214_123B6999A6E5D86B0F95B4227831AA50.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884823','1423884823');
INSERT INTO jh_product VALUES ('69','黄色心形抱枕','黄色心形抱枕','15','3','1','0','7','0','平方米','28.00','28.00','0','demo/product/201502/20150214_A0A5DF70A2AA73107F427A530BBDCF15.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884824','1423884824');
INSERT INTO jh_product VALUES ('70','棉麻拼接窗帘定制 喵喵style','棉麻拼接窗帘定制 喵喵style','1','4','1','0','7','0','平方米','99.00','99.00','0','demo/product/201502/20150214_1252C822941478F576D2ABBA6B5F5B44.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884824','1423884824');
INSERT INTO jh_product VALUES ('71','空气炸锅，真正无油煎炸 健康之选','空气炸锅，真正无油煎炸 健康之选','10','1','1','0','7','0','平方米','638.00','638.00','0','demo/product/201502/20150214_9E613C547BE2AF55C4CB30A31E3824EA.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884824','1423884824');
INSERT INTO jh_product VALUES ('72','老公老婆毛巾（一对）','老公老婆毛巾（一对）','12','4','1','0','7','0','平方米','24.00','24.00','0','demo/product/201502/20150214_2BD82F9AC7C744B6F972B3AD173D4198.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884825','1423884825');
INSERT INTO jh_product VALUES ('73','新西兰羊毛地毯 卧室地毯 客厅地毯','新西兰羊毛地毯 卧室地毯 客厅地毯','14','3','1','0','7','0','平方米','2999.00','2999.00','0','demo/product/201502/20150214_C2EBF1DBD20F3C82D77F19FDCA478F52.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884825','1423884825');
INSERT INTO jh_product VALUES ('74','EG823MF7-NRH3 高端蒸立方家用大容量23L微波炉','EG823MF7-NRH3 高端蒸立方家用大容量23L微波炉','15','2','1','0','7','0','平方米','899.00','899.00','0','demo/product/201502/20150214_29F1AB3C3FB0D94C0B83FC9D7783B29E.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884825','1423884825');
INSERT INTO jh_product VALUES ('75','SKG 4705+4905烟机灶具套装 智能侧吸式吸油烟机燃气灶套餐','SKG 4705+4905烟机灶具套装 智能侧吸式吸油烟机燃气灶套餐','15','3','1','0','7','0','平方米','1399.00','1399.00','0','demo/product/201502/20150214_95DB2FC26A49C45F324507B22A19B663.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884825','1423884825');
INSERT INTO jh_product VALUES ('76','1219 面条机 家用电动 全自动面条机','1219 面条机 家用电动 全自动面条机','14','2','1','0','7','0','平方米','668.00','668.00','0','demo/product/201502/20150214_390E4DB532ACD10F88C4FCF094A97FC2.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884826','1423884826');
INSERT INTO jh_product VALUES ('77','新款白色熊猫-小号','新款白色熊猫-小号','8','3','1','0','7','0','平方米','58.00','58.00','0','demo/product/201502/20150214_9D8D91AE03075F2E70859262EB3FE8D2.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884826','1423884826');
INSERT INTO jh_product VALUES ('78','4208空气净化器 除甲醛PM.5 家用净化机 除二手烟','4208空气净化器 除甲醛PM.5 家用净化机 除二手烟','14','3','1','0','7','0','平方米','5999.00','5999.00','0','demo/product/201502/20150214_7D59A5B74E311705728AF4E2A9E94F23.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884826','1423884826');
INSERT INTO jh_product VALUES ('79','时尚干衣机多功能干衣机暖风机快速烘干机','时尚干衣机多功能干衣机暖风机快速烘干机','13','2','1','0','7','0','平方米','258.00','258.00','0','demo/product/201502/20150214_7E9A6964C204CA20777017C0D197B1F2.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884827','1423884827');
INSERT INTO jh_product VALUES ('80','1763   精准双控温旋转叉家用电烤箱','1763   精准双控温旋转叉家用电烤箱','4','4','1','0','7','0','平方米','339.00','339.00','0','demo/product/201502/20150214_23D289CA4E40984A74B77EC004A4D289.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884827','1423884827');
INSERT INTO jh_product VALUES ('81','90QD301嵌入式消毒柜/消毒碗柜/家用消毒碗柜 90L','90QD301嵌入式消毒柜/消毒碗柜/家用消毒碗柜 90L','14','3','1','0','7','0','平方米','989.00','989.00','0','demo/product/201502/20150214_72D2DDA4BED8B4FA400ADE96B9458D3A.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884828','1423884828');
INSERT INTO jh_product VALUES ('82','3922 全自动不锈钢家用面包机','3922 全自动不锈钢家用面包机','7','3','1','0','7','0','平方米','328.00','328.00','0','demo/product/201502/20150214_6F9CAB5D386A1B0029A9463D8A1CD8E8.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884828','1423884828');
INSERT INTO jh_product VALUES ('83','净水器家用直饮净水机J1105-ROB8自来水过滤器','净水器家用直饮净水机J1105-ROB8自来水过滤器','8','1','1','0','7','0','平方米','1498.00','1498.00','0','demo/product/201502/20150214_3841A69025C81AF11D2098E39E473A28.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884829','1423884829');
INSERT INTO jh_product VALUES ('84','3006 家用智能豆芽机','3006 家用智能豆芽机','1','4','1','0','7','0','平方米','118.00','118.00','0','demo/product/201502/20150214_7733D75BBC04C53542A664FFA635F092.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884829','1423884829');
INSERT INTO jh_product VALUES ('85','5210 分体壁挂式定频家用冷暖空调 1匹','5210 分体壁挂式定频家用冷暖空调 1匹','1','2','1','0','7','0','平方米','3400.00','3400.00','0','demo/product/201502/20150214_B9B0195338DEF463BAA4686952428E99.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884830','1423884830');
INSERT INTO jh_product VALUES ('86','SF1042 电热水壶 不锈钢 防干烧 1.8L','SF1042 电热水壶 不锈钢 防干烧 1.8L','15','3','1','0','7','0','平方米','138.00','138.00','0','demo/product/201502/20150214_5E8A43AD367B7B4671F9C184957619E3.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884830','1423884830');
INSERT INTO jh_product VALUES ('87','1821超声波静音加湿器','1821超声波静音加湿器','4','2','1','0','7','0','平方米','79.00','79.00','0','demo/product/201502/20150214_510F03C774C4EED9DAC437E9AE93C144.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884830','1423884830');
INSERT INTO jh_product VALUES ('88','28196 电压力锅 家用多功能 电脑版预约功能 5L','28196 电压力锅 家用多功能 电脑版预约功能 5L','10','1','1','0','7','0','平方米','1799.00','1799.00','0','demo/product/201502/20150214_A4FE1C0FFA4688EAD3F60BBD0B42F52D.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884831','1423884831');
INSERT INTO jh_product VALUES ('89','1601 远红外不锈钢电陶炉','1601 远红外不锈钢电陶炉','2','2','1','0','7','0','平方米','199.00','199.00','0','demo/product/201502/20150214_F7EB42A3073C6A3127D6147686BDFAAA.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884831','1423884831');
INSERT INTO jh_product VALUES ('90','2365手提式蒸汽挂烫机 家用迷你便携蒸汽熨斗烫衣机 200ml','2365手提式蒸汽挂烫机 家用迷你便携蒸汽熨斗烫衣机 200ml','15','2','1','0','7','0','平方米','89.00','89.00','0','demo/product/201502/20150214_79465B6ADD824C7049B51B2291BB0616.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884831','1423884831');
INSERT INTO jh_product VALUES ('91','4012电动洗脸刷洁面仪毛孔清洁器','4012电动洗脸刷洁面仪毛孔清洁器','15','2','1','0','7','0','平方米','79.00','79.00','0','demo/product/201502/20150214_28646735BB11C7A4A8F89B6D601DBC69.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884832','1423884832');
INSERT INTO jh_product VALUES ('92','3849 家用真空吸尘器 龙卷旋风尘过滤','3849 家用真空吸尘器 龙卷旋风尘过滤','16','4','1','0','7','0','平方米','529.00','529.00','0','demo/product/201502/20150214_50BC4C3942A6B244A545476BE3C51F5C.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884832','1423884832');
INSERT INTO jh_product VALUES ('93','4016 全身多功能按摩靠垫','4016 全身多功能按摩靠垫','15','4','1','0','7','0','平方米','699.00','699.00','0','demo/product/201502/20150214_E165E9E423E16DDD475CB46CDC6275C3.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884833','1423884833');
INSERT INTO jh_product VALUES ('94','5001 电热水器40升 储水式速热电热水器','5001 电热水器40升 储水式速热电热水器','11','1','1','0','7','0','平方米','549.00','549.00','0','demo/product/201502/20150214_4F1CA228DAB5F61CC928558CB577147F.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884833','1423884833');
INSERT INTO jh_product VALUES ('95','2170豪华智能微电脑电饭煲','2170豪华智能微电脑电饭煲','8','3','1','0','7','0','平方米','698.00','698.00','0','demo/product/201502/20150214_F775A72649CE238A1B8F7A8B3A958919.jpg','1','0','0','0','0','','0','Y','0','0','0','0','0','0','0','0','50','1','0','1423884834','1423884834');
DROP TABLE IF EXISTS jh_product_attr;
CREATE TABLE `jh_product_attr` (
  `product_id` int(10) NOT NULL DEFAULT '0',
  `attr_id` smallint(6) NOT NULL DEFAULT '0',
  `attr_value_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_product_comment;
CREATE TABLE `jh_product_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) unsigned DEFAULT '0',
  `city_id` smallint(6) DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT '0',
  `uid` mediumint(8) unsigned DEFAULT '0',
  `score` tinyint(3) unsigned DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `reply` varchar(255) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `shop_id` (`audit`,`shop_id`),
  KEY `product_id` (`audit`,`product_id`),
  KEY `uid` (`uid`,`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 AUTO_INCREMENT=26;

DROP TABLE IF EXISTS jh_product_fields;
CREATE TABLE `jh_product_fields` (
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(255) DEFAULT '',
  `info` mediumtext,
  `clientip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_product_fields VALUES ('1','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('2','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('3','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('4','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('5','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('6','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('7','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('8','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('9','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('10','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('11','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('12','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('13','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('14','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('15','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('16','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('17','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('18','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('19','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('20','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('21','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('22','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('23','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('24','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('25','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('26','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('27','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('28','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('29','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('30','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('31','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('32','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('33','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('34','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('35','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('36','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('37','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('38','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('39','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('40','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('41','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('42','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('43','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('44','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('45','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('46','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('47','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('48','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('49','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('50','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('51','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('52','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('53','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('54','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('55','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('56','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('57','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('58','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('59','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('60','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('61','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('62','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('63','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('64','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('65','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('66','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('67','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('68','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('69','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('70','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('71','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('72','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('73','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('74','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('75','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('76','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('77','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('78','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('79','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('80','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('81','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('82','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('83','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('84','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('85','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('86','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('87','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('88','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('89','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('90','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('91','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('92','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('93','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('94','','','','','127.0.0.1');
INSERT INTO jh_product_fields VALUES ('95','','','','','127.0.0.1');
DROP TABLE IF EXISTS jh_product_photo;
CREATE TABLE `jh_product_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT '0',
  `shop_id` mediumint(8) DEFAULT '0',
  `photo` varchar(510) DEFAULT '',
  `title` varchar(100) DEFAULT '',
  `size` smallint(6) unsigned DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `dateline` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `product_id` (`product_id`,`orderby`),
  KEY `shop_id` (`shop_id`,`orderby`)
) ENGINE=MyISAM AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1006;

INSERT INTO jh_product_photo VALUES ('1','2','0','demo/product/201502/20150214_FF1457500CD6B44B4926ADEA25812D75.jpg','SUS304不锈钢防臭地漏1','27098','50','1423884798');
INSERT INTO jh_product_photo VALUES ('2','1','0','demo/product/201502/20150214_D521621D1995B0C1212420B12D079CDF.jpg','尊享法式高端家具 奢华真皮布艺结合沙发 沙发套装（1+2+3+6腰枕）1','65535','50','1423884798');
INSERT INTO jh_product_photo VALUES ('3','3','0','demo/product/201502/20150214_7D989CBDF2FE4FA51E221A569E195A79.jpg','高靠背亚克力浴缸 独立式浴缸 椭圆形单人浴缸1','65535','50','1423884798');
INSERT INTO jh_product_photo VALUES ('4','4','0','demo/product/201502/20150214_A4F87C1F996666485E5A6DA3B2FB0A85.jpg','圆角三层架挂件 不锈钢卫浴挂件1','52150','50','1423884799');
INSERT INTO jh_product_photo VALUES ('5','5','0','demo/product/201502/20150214_38B7608C1531B1952E144E5741963C3D.jpg','卧室1.8米床3套装1','65535','50','1423884799');
INSERT INTO jh_product_photo VALUES ('6','6','0','demo/product/201502/20150214_73357D4815BBC3EA2AE32415FAFB708B.jpg','布艺餐椅 无扶手餐椅1','65535','50','1423884799');
INSERT INTO jh_product_photo VALUES ('7','7','0','demo/product/201502/20150214_B30F9016EA23678A23F7689717B8499B.jpg','户外罗马伞 岗亭伞 遮阳伞  铝合金伞1','65535','50','1423884800');
INSERT INTO jh_product_photo VALUES ('8','8','0','demo/product/201502/20150214_C39AB6AFF476E038E9ECD1D844337B1A.jpg','全实木沙发客厅5件套（1+2+3+茶几+电视柜）1','65535','50','1423884800');
INSERT INTO jh_product_photo VALUES ('9','9','0','demo/product/201502/20150214_1B595D641742D1FF1166A299D77CCD49.jpg','典雅大气 纯手工雕花 顶级美国进口黄杨实木电视柜1','65535','50','1423884800');
INSERT INTO jh_product_photo VALUES ('10','10','0','demo/product/201502/20150214_7232FB99171479ADCFF16134E237F8FF.jpg','儒雅典范 唯美浪漫雕花 华贵耐磨雪尼尔布艺沙发套装（1+2+3）1','65535','50','1423884801');
INSERT INTO jh_product_photo VALUES ('11','12','0','demo/product/201502/20150214_3B43FB4CD617D358E36AAF31FA769224.jpg','圆形陶瓷洗手盆 台上式洗脸盆 台盆1','30673','50','1423884801');
INSERT INTO jh_product_photo VALUES ('12','11','0','demo/product/201502/20150214_4AF78CBA1796D0B4FBA674C6121A0D94.jpg','1.2米实木床 双层儿童床 板条床1','65535','50','1423884801');
INSERT INTO jh_product_photo VALUES ('13','13','0','demo/product/201502/20150214_7FEDBE846CAA976DE7CF9A483625B85A.jpg','皮艺客厅家具5件套（1+2+3+茶几+角几）1','65535','50','1423884801');
INSERT INTO jh_product_photo VALUES ('14','14','0','demo/product/201502/20150214_94F5ED8F5D68E14092B07BFBF6505FC3.jpg','白色家具田园双门酒柜1','64600','50','1423884802');
INSERT INTO jh_product_photo VALUES ('15','15','0','demo/product/201502/20150214_3F19A351724A28F88879BA9E279A8794.jpg','超豪华1.93米双人床 黄牛双色头层真皮床 高端古典床1','65535','50','1423884802');
INSERT INTO jh_product_photo VALUES ('16','16','0','demo/product/201502/20150214_AAF4968C7377B14AC3DC2A1EFC4B4638.jpg','卧室套装（1.5米床+1床头柜+1床垫）1','65535','50','1423884802');
INSERT INTO jh_product_photo VALUES ('17','17','0','demo/product/201502/20150214_CC90F66C184F934213B62443B0E8B048.jpg','欧美 天使的翅膀8头吊灯 吊吸两用 客厅餐厅吊灯1','65535','50','1423884802');
INSERT INTO jh_product_photo VALUES ('18','18','0','demo/product/201502/20150214_5F9858B95FFABA0B7D65362106C26453.jpg','多功能电脑台书柜组合1','65535','50','1423884803');
INSERT INTO jh_product_photo VALUES ('19','19','0','demo/product/201502/20150214_E7972AE8377CDDAF11C74737E20BEC92.jpg','【美姿·朝霞】1.53米SRX钛合金弹簧床垫 健康环保床垫1','30591','50','1423884803');
INSERT INTO jh_product_photo VALUES ('20','20','0','demo/product/201502/20150214_2A94472405B464B479045F252CFEDAB3.jpg','经典传承  进口桦木复古款1.6米长餐台1','65535','50','1423884803');
INSERT INTO jh_product_photo VALUES ('21','21','0','demo/product/201502/20150214_4EDDE4B89A6E79821098D6854A901B2F.jpg','品牌法式家具-卧室华美1.93米加大双人床 豪华实木床1','65535','50','1423884804');
INSERT INTO jh_product_photo VALUES ('22','22','0','demo/product/201502/20150214_81A3F5962B085FD2C711576AB7E4BB42.jpg','家用环保强化地板12mm1','65535','50','1423884804');
INSERT INTO jh_product_photo VALUES ('23','23','0','demo/product/201502/20150214_0135A3F1262ECF959C18284A093CF26F.jpg','白色四门衣柜 雕花衣柜 板式衣柜1','48290','50','1423884804');
INSERT INTO jh_product_photo VALUES ('24','24','0','demo/product/201502/20150214_955E75545B8DE57890C0610A54B91C1F.jpg','典雅精致书房家具 荷花白实用书桌1','65535','50','1423884805');
INSERT INTO jh_product_photo VALUES ('25','25','0','demo/product/201502/20150214_FC97D3152DE797C1DD19B09F4A303ADD.jpg','全铜纯白8寸大顶喷时尚升降花洒套装1','37794','50','1423884805');
INSERT INTO jh_product_photo VALUES ('26','26','0','demo/product/201502/20150214_BD3B0C8B5CDA12C0FFC950926F6CD82A.jpg','3W球泡灯（暖白光） E27灯泡1','17687','50','1423884806');
INSERT INTO jh_product_photo VALUES ('27','27','0','demo/product/201502/20150214_2C20E24D67400E7E6D3D760661CB92E9.jpg','高贵典雅的四门衣柜 板式衣柜1','65535','50','1423884806');
INSERT INTO jh_product_photo VALUES ('28','28','0','demo/product/201502/20150214_7BC10B02ACAC3A802416F154C3227329.jpg','埃菲尔多彩陶瓷沙发垫1','65535','50','1423884806');
INSERT INTO jh_product_photo VALUES ('29','29','0','demo/product/201502/20150214_FAB0A41AB6174E84EE85EEEC523F7DD1.jpg','简约蓝色儿童床 进口实木床 1.2米床板条床1','65535','50','1423884807');
INSERT INTO jh_product_photo VALUES ('30','31','0','demo/product/201502/20150214_CAE04D2B4399D3B9A4B4A37ED1DE0D2D.jpg','实木可折叠蝴蝶餐桌1','65535','50','1423884807');
INSERT INTO jh_product_photo VALUES ('31','30','0','demo/product/201502/20150214_235FDFB1379B4B098125548A7411AF8B.jpg','欧式奢华提花高档定制客厅卧室半遮光窗帘 素雅灰1','65535','50','1423884807');
INSERT INTO jh_product_photo VALUES ('32','32','0','demo/product/201502/20150214_85A6722E4DEF68E2DF905E7ADF0D9EC4.jpg','现代 3W暖白光 尖尾蜡烛灯 E14灯泡1','47702','50','1423884808');
INSERT INTO jh_product_photo VALUES ('33','33','0','demo/product/201502/20150214_E7C3115EA144D42650D0336713CA5E0A.jpg','高档欧式风格全遮光双面提花布料成品卧室客厅窗帘M133 浅咖色1','65535','50','1423884808');
INSERT INTO jh_product_photo VALUES ('34','34','0','demo/product/201502/20150214_0F33707AA4E203C8D5D176B8C3BE775D.jpg','Amy艾美 1.8米床垫 3D椰棕床垫 弹簧床垫1','65535','50','1423884809');
INSERT INTO jh_product_photo VALUES ('35','35','0','demo/product/201502/20150214_52AD76E47580DC3CD3CAD3D70BCA5942.jpg','迷城系列沙发垫 80*80（一人位）1','65535','50','1423884809');
INSERT INTO jh_product_photo VALUES ('36','36','0','demo/product/201502/20150214_260BD0982FE9C6997DDA328B73DD220E.jpg','时尚陶瓷立柱洗脸盆 白色立柱盆 美观大方洗脸盆1','65535','50','1423884810');
INSERT INTO jh_product_photo VALUES ('37','37','0','demo/product/201502/20150214_34E34DEC67712A6F795CF9A9FFCEC52D.jpg','幸福一生套巾（2毛巾+1浴巾）（蓝色）1','65535','50','1423884810');
INSERT INTO jh_product_photo VALUES ('38','38','0','demo/product/201502/20150214_F883A78055549B01802C2F18CBA79EC6.jpg','实木框架餐椅 简洁大方餐椅 浪漫温馨餐厅家具1','65535','50','1423884810');
INSERT INTO jh_product_photo VALUES ('39','39','0','demo/product/201502/20150214_2065BF329FB8FECF378E725DCAF856C3.jpg','欧式高档黄咖色镂空窗纱加厚全遮光布窗帘 黄咖色1','65535','50','1423884811');
INSERT INTO jh_product_photo VALUES ('40','40','0','demo/product/201502/20150214_F954BCCD8D3CDEB034B7E48E06E235D8.jpg','手工雕花单门酒柜 玻璃柜门典雅酒柜 进口系列酒柜1','58787','50','1423884811');
INSERT INTO jh_product_photo VALUES ('41','41','0','demo/product/201502/20150214_B0B0528AFEA7DC3FEF759A075701EE0D.jpg','塞纳舞曲系列 桌布  餐桌布 高档桌布 多功能盖巾盖布  110*160cm1','65535','50','1423884811');
INSERT INTO jh_product_photo VALUES ('42','42','0','demo/product/201502/20150214_0F72BD09E7648F7D4CC0165FCD86768C.jpg','欧美 纯手工彩绘旗舰6头吊灯 皇室风格 客厅餐厅卧室1','57259','50','1423884812');
INSERT INTO jh_product_photo VALUES ('43','43','0','demo/product/201502/20150214_E4C16090BF309BF168B5B47CF8CD8BAE.jpg','涤棉物理遮光窗帘定制 巴黎野玫瑰1','65535','50','1423884813');
INSERT INTO jh_product_photo VALUES ('44','44','0','demo/product/201502/20150214_0BF5C5AA6EE1546B0E01638D5A165DD9.jpg','涤棉遮光窗帘定制八色可选 宝蓝1','65118','50','1423884813');
INSERT INTO jh_product_photo VALUES ('45','45','0','demo/product/201502/20150214_A6CF0F89B1D51B3F132AA27E2F1165BB.jpg','粉色长颈鹿三套装1','65535','50','1423884813');
INSERT INTO jh_product_photo VALUES ('46','46','0','demo/product/201502/20150214_61F2FEE195F52B930F2B858DACC74601.jpg','品牌欧式绣花窗帘 落地帘 别墅酒店高档客厅定制弗罗拉1','65535','50','1423884814');
INSERT INTO jh_product_photo VALUES ('47','47','0','demo/product/201502/20150214_0E102AD5430A032761D2F3CFE009A62E.jpg','高档布艺 纯棉窗帘定制 红蓝条格1','65535','50','1423884816');
INSERT INTO jh_product_photo VALUES ('48','48','0','demo/product/201502/20150214_F73CB7248C113F500414D87D7ADF3A70.jpg','美罗客厅卧室地毯 客厅地毯 （多尺寸可选）香槟1','65535','50','1423884816');
INSERT INTO jh_product_photo VALUES ('49','49','0','demo/product/201502/20150214_A9F1309C4BC7FDD5C42A1C2A55003570.jpg','净水器J1330-UF60T家用自来水龙头净水器直饮厨房台面净化直饮机1','18802','50','1423884816');
INSERT INTO jh_product_photo VALUES ('50','50','0','demo/product/201502/20150214_44C55CF90EE468061E000F9CC832F2B2.jpg','醉恋巴比伦系列沙发套  沙发蒙  沙发巾  沙发罩  190*210cm1','65535','50','1423884817');
INSERT INTO jh_product_photo VALUES ('51','51','0','demo/product/201502/20150214_96F06F5606856119261E5237F68102EF.jpg','卢浮漫金 欧式宫廷款 高档丝绒烫金布艺 椅垫1','65535','50','1423884817');
INSERT INTO jh_product_photo VALUES ('52','52','0','demo/product/201502/20150214_9F58C8ADB37173595A7F757EDEF85FEF.jpg','4710+4905+3613侧吸式抽油烟机灶具消毒柜套装 烟灶消三件套装1','38277','50','1423884817');
INSERT INTO jh_product_photo VALUES ('53','54','0','demo/product/201502/20150214_634ADC4CC9895EA57E55DA3968287541.jpg','4703+4905机灶具套装 侧吸式油烟机燃气灶套餐1','38974','50','1423884818');
INSERT INTO jh_product_photo VALUES ('54','55','0','demo/product/201502/20150214_545229107174BE71CC4F454B2A0C1919.jpg','蓝色方格毛巾被1','65433','50','1423884818');
INSERT INTO jh_product_photo VALUES ('55','53','0','demo/product/201502/20150214_7A340992238D5C6D1AF91CF86DFF6418.jpg','美佳剪花立体地毯 客厅地毯（多尺寸可选）05Y1','65535','50','1423884818');
INSERT INTO jh_product_photo VALUES ('56','56','0','demo/product/201502/20150214_5623406E169F11E1839FA7FC2F9D867C.jpg','XQS70-Z1216A 7公斤双动力全自动波轮洗衣机1','14078','50','1423884819');
INSERT INTO jh_product_photo VALUES ('57','57','0','demo/product/201502/20150214_E417A2E106315465BDFC36FCD4281F5A.jpg','高档简约纯棉窗帘定制 挪威森林1','65535','50','1423884819');
INSERT INTO jh_product_photo VALUES ('58','58','0','demo/product/201502/20150214_E70BB075CB2B9238537157D1D6E53BB4.jpg','涤棉窗帘定制 地中海风 蓝白咖1','59354','50','1423884820');
INSERT INTO jh_product_photo VALUES ('59','59','0','demo/product/201502/20150214_84092B8C51EF535D0537E8EC546AC587.jpg','SAMSUNG SFN-ZX88RDB电子式遥控电风扇落地扇 机械臂 摇头扇1','27951','50','1423884820');
INSERT INTO jh_product_photo VALUES ('60','60','0','demo/product/201502/20150214_2A5ADAEEB15D24EEED38422883BE6F3C.jpg','高档仿麻窗纱 成品定制 白色方格1','54789','50','1423884820');
INSERT INTO jh_product_photo VALUES ('61','61','0','demo/product/201502/20150214_A8DCDCE8735C4B14610AC9A8B2E2E720.jpg','高档半遮光窗帘定制 速写英伦1','65535','50','1423884821');
INSERT INTO jh_product_photo VALUES ('62','62','0','demo/product/201502/20150214_7A926E942390A9DCDDE365AFDD24B640.jpg','SAMSUNG SFN-ZX88MDB超静音落地电风扇 定时摇头 落地扇1','27951','50','1423884821');
INSERT INTO jh_product_photo VALUES ('63','63','0','demo/product/201502/20150214_B0244DC3CE52059F82D618351F5E1112.jpg','土黄色熊1','65535','50','1423884822');
INSERT INTO jh_product_photo VALUES ('64','64','0','demo/product/201502/20150214_77A57E657764150CBC963B55F98FC5BB.jpg','神奇无痕粘贴式马桶垫 7套装1','43772','50','1423884822');
INSERT INTO jh_product_photo VALUES ('65','65','0','demo/product/201502/20150214_5C6E8DDEFE247B23FFFCE52DCAC6CEB0.jpg','3135跑步机 多功能静音折叠跑步机 健身器材 【全国联保】1','51015','50','1423884822');
INSERT INTO jh_product_photo VALUES ('66','66','0','demo/product/201502/20150214_85730EEBDA1F666006E33378DCA36CE0.jpg','800纬剪花地毯 卧室地毯 客厅地毯 2*2.8米1','65535','50','1423884823');
INSERT INTO jh_product_photo VALUES ('67','67','0','demo/product/201502/20150214_5AAA9F25B82C472DF06F1B57D474C9EB.jpg','外贸单全棉双股纱波浪浴巾2条装（粉色）1','65535','50','1423884823');
INSERT INTO jh_product_photo VALUES ('68','68','0','demo/product/201502/20150214_123B6999A6E5D86B0F95B4227831AA50.jpg','BCD-579WE 579容升定频风冷对开门冰箱 白色（水韵纹）1级能效1','6657','50','1423884823');
INSERT INTO jh_product_photo VALUES ('69','69','0','demo/product/201502/20150214_A0A5DF70A2AA73107F427A530BBDCF15.jpg','黄色心形抱枕1','65535','50','1423884824');
INSERT INTO jh_product_photo VALUES ('70','70','0','demo/product/201502/20150214_1252C822941478F576D2ABBA6B5F5B44.jpg','棉麻拼接窗帘定制 喵喵style1','65535','50','1423884824');
INSERT INTO jh_product_photo VALUES ('71','71','0','demo/product/201502/20150214_9E613C547BE2AF55C4CB30A31E3824EA.jpg','空气炸锅，真正无油煎炸 健康之选1','27103','50','1423884824');
INSERT INTO jh_product_photo VALUES ('72','73','0','demo/product/201502/20150214_C2EBF1DBD20F3C82D77F19FDCA478F52.jpg','新西兰羊毛地毯 卧室地毯 客厅地毯1','65535','50','1423884825');
INSERT INTO jh_product_photo VALUES ('73','74','0','demo/product/201502/20150214_29F1AB3C3FB0D94C0B83FC9D7783B29E.jpg','EG823MF7-NRH3 高端蒸立方家用大容量23L微波炉1','19259','50','1423884825');
INSERT INTO jh_product_photo VALUES ('74','72','0','demo/product/201502/20150214_2BD82F9AC7C744B6F972B3AD173D4198.jpg','老公老婆毛巾（一对）1','65535','50','1423884825');
INSERT INTO jh_product_photo VALUES ('75','75','0','demo/product/201502/20150214_95DB2FC26A49C45F324507B22A19B663.jpg','SKG 4705+4905烟机灶具套装 智能侧吸式吸油烟机燃气灶套餐1','46932','50','1423884825');
INSERT INTO jh_product_photo VALUES ('76','76','0','demo/product/201502/20150214_390E4DB532ACD10F88C4FCF094A97FC2.jpg','1219 面条机 家用电动 全自动面条机1','65535','50','1423884826');
INSERT INTO jh_product_photo VALUES ('77','77','0','demo/product/201502/20150214_9D8D91AE03075F2E70859262EB3FE8D2.jpg','新款白色熊猫-小号1','61719','50','1423884826');
INSERT INTO jh_product_photo VALUES ('78','78','0','demo/product/201502/20150214_7D59A5B74E311705728AF4E2A9E94F23.jpg','4208空气净化器 除甲醛PM.5 家用净化机 除二手烟1','21024','50','1423884826');
INSERT INTO jh_product_photo VALUES ('79','79','0','demo/product/201502/20150214_7E9A6964C204CA20777017C0D197B1F2.jpg','时尚干衣机多功能干衣机暖风机快速烘干机1','22860','50','1423884827');
INSERT INTO jh_product_photo VALUES ('80','80','0','demo/product/201502/20150214_23D289CA4E40984A74B77EC004A4D289.jpg','1763   精准双控温旋转叉家用电烤箱1','65535','50','1423884827');
INSERT INTO jh_product_photo VALUES ('81','81','0','demo/product/201502/20150214_72D2DDA4BED8B4FA400ADE96B9458D3A.jpg','90QD301嵌入式消毒柜/消毒碗柜/家用消毒碗柜 90L1','18736','50','1423884828');
INSERT INTO jh_product_photo VALUES ('82','82','0','demo/product/201502/20150214_6F9CAB5D386A1B0029A9463D8A1CD8E8.jpg','3922 全自动不锈钢家用面包机1','24974','50','1423884828');
INSERT INTO jh_product_photo VALUES ('83','83','0','demo/product/201502/20150214_3841A69025C81AF11D2098E39E473A28.jpg','净水器家用直饮净水机J1105-ROB8自来水过滤器1','21554','50','1423884829');
INSERT INTO jh_product_photo VALUES ('84','84','0','demo/product/201502/20150214_7733D75BBC04C53542A664FFA635F092.jpg','3006 家用智能豆芽机1','39731','50','1423884829');
INSERT INTO jh_product_photo VALUES ('85','85','0','demo/product/201502/20150214_B9B0195338DEF463BAA4686952428E99.jpg','5210 分体壁挂式定频家用冷暖空调 1匹1','26655','50','1423884830');
INSERT INTO jh_product_photo VALUES ('86','86','0','demo/product/201502/20150214_5E8A43AD367B7B4671F9C184957619E3.jpg','SF1042 电热水壶 不锈钢 防干烧 1.8L1','34994','50','1423884830');
INSERT INTO jh_product_photo VALUES ('87','87','0','demo/product/201502/20150214_510F03C774C4EED9DAC437E9AE93C144.jpg','1821超声波静音加湿器1','40438','50','1423884830');
INSERT INTO jh_product_photo VALUES ('88','88','0','demo/product/201502/20150214_A4FE1C0FFA4688EAD3F60BBD0B42F52D.jpg','28196 电压力锅 家用多功能 电脑版预约功能 5L1','38733','50','1423884831');
INSERT INTO jh_product_photo VALUES ('89','89','0','demo/product/201502/20150214_F7EB42A3073C6A3127D6147686BDFAAA.jpg','1601 远红外不锈钢电陶炉1','49637','50','1423884831');
INSERT INTO jh_product_photo VALUES ('90','90','0','demo/product/201502/20150214_79465B6ADD824C7049B51B2291BB0616.jpg','2365手提式蒸汽挂烫机 家用迷你便携蒸汽熨斗烫衣机 200ml1','27491','50','1423884831');
INSERT INTO jh_product_photo VALUES ('91','91','0','demo/product/201502/20150214_28646735BB11C7A4A8F89B6D601DBC69.jpg','4012电动洗脸刷洁面仪毛孔清洁器1','17064','50','1423884832');
INSERT INTO jh_product_photo VALUES ('92','92','0','demo/product/201502/20150214_50BC4C3942A6B244A545476BE3C51F5C.jpg','3849 家用真空吸尘器 龙卷旋风尘过滤1','56410','50','1423884832');
INSERT INTO jh_product_photo VALUES ('93','93','0','demo/product/201502/20150214_E165E9E423E16DDD475CB46CDC6275C3.jpg','4016 全身多功能按摩靠垫1','29650','50','1423884833');
INSERT INTO jh_product_photo VALUES ('94','94','0','demo/product/201502/20150214_4F1CA228DAB5F61CC928558CB577147F.jpg','5001 电热水器40升 储水式速热电热水器1','22698','50','1423884833');
INSERT INTO jh_product_photo VALUES ('95','95','0','demo/product/201502/20150214_F775A72649CE238A1B8F7A8B3A958919.jpg','2170豪华智能微电脑电饭煲1','32168','50','1423884834');
DROP TABLE IF EXISTS jh_product_spec;
CREATE TABLE `jh_product_spec` (
  `spec_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `spec_name` varchar(50) DEFAULT '',
  `spec_photo` varchar(150) DEFAULT '',
  `sale_sku` mediumint(8) DEFAULT '0',
  `sale_count` mediumint(8) DEFAULT '0',
  PRIMARY KEY (`spec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_rebate_log;
CREATE TABLE `jh_rebate_log` (
  `log_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `shop_id` mediumint(8) NOT NULL,
  `from` tinyint(1) NOT NULL DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `contact` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `card` varchar(20) DEFAULT NULL,
  `status` smallint(3) DEFAULT '1',
  `shop_remark` text,
  `admin_remark` text,
  `last_time` int(10) DEFAULT NULL,
  `evidence` varchar(150) DEFAULT NULL,
  `clientip` char(15) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_session;
CREATE TABLE `jh_session` (
  `SSID` char(35) NOT NULL,
  `uid` mediumint(8) DEFAULT '0',
  `city_id` mediumint(8) DEFAULT '0',
  `ip` char(15) DEFAULT '0.0.0.0',
  `data` varchar(1024) DEFAULT NULL,
  `lastupdate` int(10) DEFAULT '0',
  PRIMARY KEY (`SSID`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

INSERT INTO jh_session VALUES ('jt2mrdmti5vdun7eeraaolk0g5','0','0','111.194.236.191','SSID|s:26:\"jt2mrdmti5vdun7eeraaolk0g5\";VIMGCODE|s:4:\"FQJG\";','1481249606');
DROP TABLE IF EXISTS jh_shop;
CREATE TABLE `jh_shop` (
  `shop_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `group_id` smallint(6) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `cat_id` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(6) DEFAULT '0',
  `domain` varchar(10) DEFAULT '',
  `title` varchar(150) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `logo` varchar(150) DEFAULT '',
  `thumb` varchar(150) DEFAULT '',
  `contact` varchar(50) DEFAULT '',
  `phone` varchar(20) DEFAULT '',
  `xiaobao` mediumint(8) DEFAULT '0',
  `views` int(10) DEFAULT '0',
  `credit` int(10) DEFAULT '0',
  `score` int(10) DEFAULT '0',
  `comments` mediumint(8) DEFAULT '0',
  `products` mediumint(6) DEFAULT '0',
  `verify_name` tinyint(1) DEFAULT '0',
  `tenders_num` mediumint(8) DEFAULT '0',
  `tenders_sign` mediumint(8) DEFAULT '0',
  `is_vip` tinyint(1) DEFAULT '0',
  `lng` varchar(15) DEFAULT '',
  `lat` varchar(15) DEFAULT '',
  `orderby` smallint(6) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `flushtime` int(10) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`shop_id`),
  KEY `orderby` (`views`,`score`,`orderby`,`flushtime`),
  KEY `__INDEX` (`cat_id`,`city_id`,`area_id`,`is_vip`,`audit`,`closed`),
  KEY `uid` (`uid`),
  KEY `domain` (`domain`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=utf8 AUTO_INCREMENT=194;

INSERT INTO jh_shop VALUES ('1','0','7','0.00','3','7','4','','来福建材专营店','来福建材专营店','','','','0551-64278115','0','0','0','0','0','89','0','0','0','0','','','0','1','1423884799','0','1423884799');
INSERT INTO jh_shop VALUES ('2','0','0','0.00','4','7','11','','志邦厨柜','志邦厨柜','demo/photo/201502/20150214_72983A7938B77B013CEA0BE7301D01D8.jpg','demo/photo/201502/20150214_72983A7938B77B013CEA0BE7301D01D8.jpg','','0551-64278115','0','1','0','0','0','0','0','0','0','0','','','0','1','1423884799','0','1423884799');
INSERT INTO jh_shop VALUES ('3','0','0','0.00','4','7','11','','开来橱柜','开来橱柜','demo/photo/201502/20150214_A9487DAA6566DEB17C27D576021FE638.gif','demo/photo/201502/20150214_A9487DAA6566DEB17C27D576021FE638.gif','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884800','0','1423884800');
INSERT INTO jh_shop VALUES ('4','0','0','0.00','3','7','7','','伟星地暖（温暖我家）环境工程有限公司','伟星地暖（温暖我家）环境工程有限公司','demo/photo/201502/20150214_4FC4607FA76EC289D4FD32BB5D4E9CF2.jpg','demo/photo/201502/20150214_4FC4607FA76EC289D4FD32BB5D4E9CF2.jpg','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884800','0','1423884800');
INSERT INTO jh_shop VALUES ('5','0','0','0.00','3','7','3','','青阳路美家居网上建材商城','青阳路美家居网上建材商城','','','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884801','0','1423884801');
INSERT INTO jh_shop VALUES ('6','0','0','0.00','3','7','10','','今顶集成吊顶合肥营销中心','今顶集成吊顶合肥营销中心','demo/photo/201502/20150214_923607D52473DA8A96AC8F0A2634A07C.jpg','demo/photo/201502/20150214_923607D52473DA8A96AC8F0A2634A07C.jpg','','0551-64278115','0','1','0','0','0','0','0','0','0','0','','','0','1','1423884801','0','1423884801');
INSERT INTO jh_shop VALUES ('7','0','0','0.00','3','7','8','','克兰斯吊顶青阳路店','克兰斯吊顶青阳路店','','','','0551-64278115','0','1','0','0','0','0','0','0','0','0','','','0','1','1423884801','0','1423884801');
INSERT INTO jh_shop VALUES ('8','0','0','0.00','1','7','7','','三六五地产家居网','三六五地产家居网','','','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884802','0','1423884802');
INSERT INTO jh_shop VALUES ('9','0','0','0.00','2','7','8','','马丁·路易卫浴国际投资有限公司','马丁·路易卫浴国际投资有限公司','demo/photo/201502/20150214_BD2CD53887E87C0C3F925008064CAD24.jpg','demo/photo/201502/20150214_BD2CD53887E87C0C3F925008064CAD24.jpg','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884801','0','1423884801');
INSERT INTO jh_shop VALUES ('10','0','0','0.00','2','7','8','','安徽鑫雅家居科技有限公司','安徽鑫雅家居科技有限公司','demo/photo/201502/20150214_21F1F4CE0BBD72B6293026A69A9DE801.png','demo/photo/201502/20150214_21F1F4CE0BBD72B6293026A69A9DE801.png','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884802','0','1423884802');
INSERT INTO jh_shop VALUES ('11','0','0','0.00','1','7','5','','兔宝宝板材/地板/木门/衣柜/移门/五金/油漆/家具（合肥市安林商贸有限公司）','兔宝宝板材/地板/木门/衣柜/移门/五金/油漆/家具（合肥市安林商贸有限公司）','demo/photo/201502/20150214_BE53E827DE86447A879D4635DB48A51C.jpg','demo/photo/201502/20150214_BE53E827DE86447A879D4635DB48A51C.jpg','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884802','0','1423884802');
INSERT INTO jh_shop VALUES ('12','0','0','0.00','2','7','7','','顶级别墅、大宅采暖及空调设计','顶级别墅、大宅采暖及空调设计','demo/photo/201502/20150214_327C8CA1B5B5744CB1105A7EF8138CE4.png','demo/photo/201502/20150214_327C8CA1B5B5744CB1105A7EF8138CE4.png','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884803','0','1423884803');
INSERT INTO jh_shop VALUES ('13','0','0','0.00','4','7','8','','美国凯乐瑞克电热膜供暖系统','美国凯乐瑞克电热膜供暖系统','demo/photo/201502/20150214_7B146E4BC60AED38538AA30EECC63C6C.png','demo/photo/201502/20150214_7B146E4BC60AED38538AA30EECC63C6C.png','','0551-64278115','0','1','0','0','0','0','0','0','0','0','','','0','1','1423884803','0','1423884803');
INSERT INTO jh_shop VALUES ('14','0','0','0.00','3','7','6','','安徽省梅菲特都芳建材科技有限公司','安徽省梅菲特都芳建材科技有限公司','demo/photo/201502/20150214_B23B67DFA4F5BDCD4BB9DC26C57E59A0.jpg','demo/photo/201502/20150214_B23B67DFA4F5BDCD4BB9DC26C57E59A0.jpg','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884804','0','1423884804');
INSERT INTO jh_shop VALUES ('15','0','0','0.00','2','7','4','','平价窗帘超市','平价窗帘超市','demo/photo/201502/20150214_03B5211E04C538628D3047D1EA7E6C9D.jpg','demo/photo/201502/20150214_03B5211E04C538628D3047D1EA7E6C9D.jpg','','0551-64278115','0','9','0','0','0','0','0','0','0','0','','','0','1','1423884805','0','1423884805');
INSERT INTO jh_shop VALUES ('16','0','0','0.00','1','7','10','','合肥科天化工有限公司','合肥科天化工有限公司','demo/photo/201502/20150214_19F7B500C6F73912B0B036F4B0FF15B7.jpg','demo/photo/201502/20150214_19F7B500C6F73912B0B036F4B0FF15B7.jpg','','0551-64278115','0','0','0','0','0','0','0','0','0','0','','','0','1','1423884805','0','1423884805');
INSERT INTO jh_shop VALUES ('17','148','7','0.00','1','7','4','','粤鑫家居专营店','粤鑫家居专营店','demo/photo/201502/20150214_FBCD27FFC8A99DA48D1C73CDD7C5D86F.jpg','demo/photo/201502/20150214_FBCD27FFC8A99DA48D1C73CDD7C5D86F.jpg','','0551-64278115','0','50','0','0','0','0','0','0','0','0','','','0','1','1423884806','0','1423884806');
DROP TABLE IF EXISTS jh_shop_attr;
CREATE TABLE `jh_shop_attr` (
  `attr_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `cat_id` mediumint(8) DEFAULT '0',
  `multi` enum('Y','N') DEFAULT 'Y',
  `filter` enum('Y','N') DEFAULT 'Y',
  `orderby` smallint(6) DEFAULT '0',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

DROP TABLE IF EXISTS jh_shop_attr_value;
CREATE TABLE `jh_shop_attr_value` (
  `attr_value_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `attr_id` smallint(6) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`attr_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

DROP TABLE IF EXISTS jh_shop_banner;
CREATE TABLE `jh_shop_banner` (
  `banner_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) DEFAULT '0',
  `photo` varchar(150) DEFAULT '',
  `title` varchar(150) DEFAULT '',
  `link` varchar(200) DEFAULT '',
  `orderby` smallint(50) DEFAULT '50',
  `dateline` int(11) DEFAULT '10',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22;

DROP TABLE IF EXISTS jh_shop_brand;
CREATE TABLE `jh_shop_brand` (
  `brand_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT '',
  `logo` varchar(150) DEFAULT '',
  `url` varchar(150) DEFAULT '',
  `desc` varchar(255) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`brand_id`),
  KEY `audit` (`audit`,`closed`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

DROP TABLE IF EXISTS jh_shop_cate;
CREATE TABLE `jh_shop_cate` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `parent_id` mediumint(8) DEFAULT '0',
  `brand_ids` varchar(200) DEFAULT '',
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(200) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=353 DEFAULT CHARSET=utf8 AUTO_INCREMENT=353;

INSERT INTO jh_shop_cate VALUES ('1','基础建材','0','','基础建材','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('2','家具','0','','家具','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('3','家电','0','','家电','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('4','软装配饰','0','','软装配饰','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('5','其他','0','','其他','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('6','灯饰照明','1','3,2,1','灯饰照明','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('7','厨房卫浴','1','','厨房卫浴','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('8','电工电料','1','','电工电料','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('9','墙地面材料','1','','墙地面材料','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('10','装饰材料','1','','装饰材料','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('11','五金工具','1','','五金工具','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('12','定制家居','1','','定制家居','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('13','智能家居','1','','智能家居','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('14','LED灯','6','','LED灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('15','台灯','6','','台灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('16','吊灯','6','','吊灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('17','日光灯','6','','日光灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('18','射灯','6','','射灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('19','吸顶灯','6','','吸顶灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('20','筒灯','6','','筒灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('21','壁灯','6','','壁灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('22','镜前灯','6','','镜前灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('23','小夜灯','6','','小夜灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('24','落地灯','6','','落地灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('25','应急灯','6','','应急灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('26','户外灯','6','','户外灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('27','橱柜','7','','橱柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('28','马桶','7','','马桶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('29','龙头','7','','龙头','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('30','浴室柜','7','','浴室柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('31','浴缸','7','','浴缸','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('32','淋浴房','7','','淋浴房','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('33','地漏','7','','地漏','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('34','水槽','7','','水槽','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('35','角阀','7','','角阀','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('36','花洒','7','','花洒','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('37','挂钩','7','','挂钩','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('38','妇洗器','7','','妇洗器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('39','置物架','7','','置物架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('40','拖把池','7','','拖把池','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('41','蹲便器','7','','蹲便器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('42','洗手盆','7','','洗手盆','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('43','小便器','7','','小便器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('44','皂液器','7','','皂液器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('45','烘手器','7','','烘手器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('46','配件','7','','配件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('47','变压器','8','','变压器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('48','继电器','8','','继电器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('49','传感器','8','','传感器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('50','开关','8','','开关','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('51','断路器','8','','断路器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('52','电线电缆','8','','电线电缆','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('53','插座','8','','插座','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('54','蓄电池','8','','蓄电池','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('55','稳压器','8','','稳压器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('56','配电箱','8','','配电箱','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('57','电源转换器','8','','电源转换器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('58','插头','8','','插头','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('59','温控器','8','','温控器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('60','节电器','8','','节电器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('61','墙纸','9','','墙纸','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('62','硅藻泥','9','','硅藻泥','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('63','瓷砖','9','','瓷砖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('64','地板','9','','地板','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('65','涂料','9','','涂料','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('66','腻子粉','9','','腻子粉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('67','金箔','9','','金箔','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('68','隔音棉','9','','隔音棉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('69','管材','9','','管材','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('70','门','10','','门','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('71','吊顶','10','','吊顶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('72','浴霸','10','','浴霸','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('73','石材','10','','石材','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('74','暖气片','10','','暖气片','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('75','楼梯','10','','楼梯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('76','钢材','10','','钢材','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('77','板材','10','','板材','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('78','窗','10','','窗','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('79','壁炉','10','','壁炉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('80','壁柜','10','','壁柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('81','采暖炉','10','','采暖炉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('82','门窗配件','10','','门窗配件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('83','法兰','11','','法兰','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('84','电动机','11','','电动机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('85','扳手','11','','扳手','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('86','弹簧','11','','弹簧','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('87','铆钉','11','','铆钉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('88','紧固件','11','','紧固件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('89','导轨','11','','导轨','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('90','冲击钻','11','','冲击钻','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('91','胶带','11','','胶带','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('92','手电钻','11','','手电钻','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('93','锯片','11','','锯片','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('94','锁具','11','','锁具','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('95','滑轨','11','','滑轨','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('96','测量工具','11','','测量工具','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('97','起重工具','11','','起重工具','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('98','定制衣柜','12','','定制衣柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('99','智能家居套装','13','','智能家居套装','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('100','背景音乐','13','','背景音乐','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('101','综合布线','13','','综合布线','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('102','电动窗帘','13','','电动窗帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('103','楼宇对讲','13','','楼宇对讲','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('104','节能环保','13','','节能环保','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('105','楼宇自控','13','','楼宇自控','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('106','感应垃圾桶','13','','感应垃圾桶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('107','智能门窗','13','','智能门窗','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('108','电源控制器','13','','电源控制器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('109','自动浇水器','13','','自动浇水器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('110','出入口控制','13','','出入口控制','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('111','卧室','2','','卧室','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('112','客厅','2','','客厅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('113','餐厅','2','','餐厅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('114','书房','2','','书房','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('115','户外','2','','户外','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('116','商业办公','2','','商业办公','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('117','床','111','','床','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('118','衣柜','111','','衣柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('119','床垫','111','','床垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('120','梳妆台','111','','梳妆台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('121','床头柜','111','','床头柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('122','梳妆凳','111','','梳妆凳','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('123','穿衣镜','111','','穿衣镜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('124','衣帽架','111','','衣帽架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('125','鞋架','111','','鞋架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('126','斗柜','111','','斗柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('127','沙发','112','','沙发','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('128','玄关','112','','玄关','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('129','榻榻米','112','','榻榻米','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('130','鞋柜','112','','鞋柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('131','电视柜','112','','电视柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('132','博古架','112','','博古架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('133','屏风','112','','屏风','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('134','椅子','112','','椅子','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('135','茶几','112','','茶几','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('136','展示柜','112','','展示柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('137','麻将桌','112','','麻将桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('138','贵妃椅','112','','贵妃椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('139','装饰柜','112','','装饰柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('140','电视架','112','','电视架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('141','组合柜','112','','组合柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('142','地柜','112','','地柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('143','视听柜','112','','视听柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('144','酒柜','113','','酒柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('145','餐桌','113','','餐桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('146','吧台','113','','吧台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('147','酒架','113','','酒架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('148','餐边柜','113','','餐边柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('149','吧台椅','113','','吧台椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('150','扶手椅','113','','扶手椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('151','靠背椅','113','','靠背椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('152','功夫茶桌','113','','功夫茶桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('153','咖啡桌','113','','咖啡桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('154','儿童椅','113','','儿童椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('155','餐椅','113','','餐椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('156','电脑桌','114','','电脑桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('157','书架','114','','书架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('158','书柜','114','','书柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('159','书桌','114','','书桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('160','学习桌','114','','学习桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('161','收纳箱','114','','收纳箱','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('162','电脑椅','114','','电脑椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('163','收纳盒','114','','收纳盒','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('164','收纳袋','114','','收纳袋','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('165','收纳柜','114','','收纳柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('166','工作台','114','','工作台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('167','转椅','114','','转椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('168','收纳架','114','','收纳架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('169','CD架','114','','CD架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('170','晾衣架','115','','晾衣架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('171','花架','115','','花架','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('172','折叠桌','115','','折叠桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('173','吊篮','115','','吊篮','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('174','马扎','115','','马扎','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('175','摇椅','115','','摇椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('176','吊床','115','','吊床','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('177','遮阳伞','115','','遮阳伞','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('178','折叠椅','115','','折叠椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('179','秋千','115','','秋千','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('180','公园椅','115','','公园椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('181','藤椅','115','','藤椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('182','休闲椅','115','','休闲椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('183','晾衣杆','115','','晾衣杆','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('184','办公桌','116','','办公桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('185','文件柜','116','','文件柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('186','办公椅','116','','办公椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('187','老板椅','116','','老板椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('188','接待台','116','','接待台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('189','会议桌','116','','会议桌','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('190','大班台','116','','大班台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('191','礼堂椅','116','','礼堂椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('192','沙发椅','116','','沙发椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('193','大班椅','116','','大班椅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('194','大家电','3','','大家电','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('195','生活电器','3','','生活电器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('196','厨房电器','3','','厨房电器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('197','个人护理','3','','个人护理','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('198','洗衣机','194','','洗衣机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('199','热水器','194','','热水器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('200','空调','194','','空调','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('201','冰箱','194','','冰箱','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('202','电视机','194','','电视机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('203','酒柜','194','','酒柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('204','家庭影院','194','','家庭影院','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('205','燃气灶','194','','燃气灶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('206','消毒柜','194','','消毒柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('207','冷柜','194','','冷柜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('208','收音机','195','','收音机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('209','净水器','195','','净水器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('210','饮水机','195','','饮水机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('211','加湿器','195','','加湿器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('212','吸尘器','195','','吸尘器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('213','净化器','195','','净化器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('214','挂烫机','195','','挂烫机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('215','干衣机','195','','干衣机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('216','取暖器','195','','取暖器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('217','电风扇','195','','电风扇','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('218','电话机','195','','电话机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('219','熨斗','195','','熨斗','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('220','冷风扇','195','','冷风扇','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('221','清洁机','195','','清洁机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('222','微波炉','196','','微波炉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('223','电磁炉','196','','电磁炉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('224','榨汁机','196','','榨汁机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('225','豆浆机','196','','豆浆机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('226','面包机','196','','面包机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('227','电饼铛','196','','电饼铛','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('228','咖啡机','196','','咖啡机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('229','抽油烟机','196','','抽油烟机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('230','电饭煲','196','','电饭煲','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('231','酸奶机','196','','酸奶机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('232','电压力锅','196','','电压力锅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('233','料理机','196','','料理机','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('234','电水壶','196','','电水壶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('235','电烤箱','196','','电烤箱','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('236','电炖锅','196','','电炖锅','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('237','煮蛋器','196','','煮蛋器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('238','剃须刀','197','','剃须刀','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('239','足浴盆','197','','足浴盆','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('240','血压计','197','','血压计','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('241','体温计','197','','体温计','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('242','电吹风','197','','电吹风','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('243','相框/画片','4','','相框/画片','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('244','挂饰贴饰','4','','挂饰贴饰','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('245','家居摆件','4','','家居摆件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('246','植物花卉','4','','植物花卉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('247','工艺饰品','4','','工艺饰品','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('248','床上用品','4','','床上用品','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('249','门窗帘幕','4','','门窗帘幕','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('250','布艺家纺','4','','布艺家纺','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('251','日用家居','4','','日用家居','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('252','书法','243','','书法','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('253','油画','243','','油画','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('254','国画','243','','国画','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('255','装饰画','243','','装饰画','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('256','相框','243','','相框','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('257','无框画','243','','无框画','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('258','瓷板画','243','','瓷板画','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('259','风铃','244','','风铃','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('260','晴天娃娃','244','','晴天娃娃','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('261','捕梦网','244','','捕梦网','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('262','墙贴','244','','墙贴','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('263','挂历','244','','挂历','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('264','玻璃贴膜','244','','玻璃贴膜','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('265','铃铛','244','','铃铛','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('266','挂钟','244','','挂钟','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('267','冰箱贴','244','','冰箱贴','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('268','开关贴','244','','开关贴','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('269','防油贴','244','','防油贴','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('270','闹钟','245','','闹钟','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('271','蜡烛','245','','蜡烛','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('272','雕刻','245','','雕刻','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('273','台历','245','','台历','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('274','纸巾盒','245','','纸巾盒','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('275','烟灰缸','245','','烟灰缸','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('276','盐灯','245','','盐灯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('277','烛台','245','','烛台','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('278','摆件','245','','摆件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('279','香薰炉','245','','香薰炉','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('280','盆景','246','','盆景','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('281','花瓶','246','','花瓶','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('282','花盆','246','','花盆','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('283','仿真植物','246','','仿真植物','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('284','花器','246','','花器','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('285','十字绣','247','','十字绣','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('286','海螺','247','','海螺','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('287','贝壳','247','','贝壳','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('288','刺绣','247','','刺绣','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('289','苏绣','247','','苏绣','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('290','树脂工艺品','247','','树脂工艺品','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('291','桌旗','247','','桌旗','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('292','熏香','247','','熏香','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('293','枕头','248','','枕头','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('294','被子','248','','被子','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('295','蚊帐','248','','蚊帐','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('296','毛毯','248','','毛毯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('297','婴儿睡袋','248','','婴儿睡袋','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('298','被套','248','','被套','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('299','床单','248','','床单','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('300','枕芯','248','','枕芯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('301','凉席','248','','凉席','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('302','枕套','248','','枕套','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('303','被芯','248','','被芯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('304','床品件套','248','','床品件套','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('305','窗帘','249','','窗帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('306','珠帘','249','','珠帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('307','浴帘','249','','浴帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('308','卷帘','249','','卷帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('309','纱窗','249','','纱窗','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('310','门帘','249','','门帘','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('311','辅料/配件','249','','辅料/配件','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('312','地毯','250','','地毯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('313','抱枕','250','','抱枕','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('314','沙发垫','250','','沙发垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('315','蒲团','250','','蒲团','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('316','坐垫','250','','坐垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('317','地垫','250','','地垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('318','马桶垫','250','','马桶垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('319','靠垫','250','','靠垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('320','飘窗垫','250','','飘窗垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('321','挂毯','250','','挂毯','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('322','桌布','250','','桌布','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('323','防尘罩','250','','防尘罩','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('324','餐垫','250','','餐垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('325','家居鞋','250','','家居鞋','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('326','拖鞋','251','','拖鞋','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('327','毛巾','251','','毛巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('328','方巾','251','','方巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('329','浴袍','251','','浴袍','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('330','浴巾','251','','浴巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('331','冰垫','251','','冰垫','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('332','美容巾','251','','美容巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('333','面巾','251','','面巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('334','澡巾','251','','澡巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('335','干发巾','251','','干发巾','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('336','地暖','5','','地暖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('337','保洁','5','','保洁','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('338','搬场','5','','搬场','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('339','家居用品','5','','家居用品','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('340','地热地暖','336','','地热地暖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('341','碳纤维电缆电暖','336','','碳纤维电缆电暖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('342','金属发热低电缆电暖','336','','金属发热低电缆电暖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('343','碳素远红外地暖','336','','碳素远红外地暖','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('344','开荒保洁','337','','开荒保洁','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('345','日常保洁/保养','337','','日常保洁/保养','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('346','垂直运输/搬运','338','','垂直运输/搬运','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('347','活性炭/家装除味','339','','活性炭/家装除味','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('348','收纳','339','','收纳','','','50','1','0','1418956948');
INSERT INTO jh_shop_cate VALUES ('349','厨房/餐饮用具','339','','厨房/餐饮用具','','','50','1','0','1418956948');
DROP TABLE IF EXISTS jh_shop_comment;
CREATE TABLE `jh_shop_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `shop_id` mediumint(8) unsigned DEFAULT '0',
  `uid` mediumint(8) unsigned DEFAULT '0',
  `score` tinyint(1) unsigned DEFAULT '1',
  `content` varchar(255) DEFAULT '',
  `reply` varchar(255) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 AUTO_INCREMENT=31;

DROP TABLE IF EXISTS jh_shop_coupon;
CREATE TABLE `jh_shop_coupon` (
  `coupon_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `money` smallint(6) DEFAULT '0',
  `min_amount` mediumint(8) DEFAULT '0',
  `content` mediumtext,
  `stime` int(10) DEFAULT '0',
  `ltime` int(10) DEFAULT '0',
  `views` mediumint(8) DEFAULT '0',
  `downloads` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`coupon_id`),
  KEY `shop_id` (`shop_id`,`audit`,`closed`,`ltime`,`orderby`),
  KEY `city_id` (`city_id`,`audit`,`closed`,`ltime`,`orderby`,`downloads`,`area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

INSERT INTO jh_shop_coupon VALUES ('1','17','7','3','新春优惠券','','200','2000','','0','0','12478','228','50','1','0','1423980202');
INSERT INTO jh_shop_coupon VALUES ('2','16','7','3','建材优惠券','','100','1500','','0','0','2697','23','50','1','0','1423980266');
INSERT INTO jh_shop_coupon VALUES ('3','10','7','3','家具优惠券','','1500','20000','','0','0','2510','168','50','1','0','1423980326');
DROP TABLE IF EXISTS jh_shop_coupon_download;
CREATE TABLE `jh_shop_coupon_download` (
  `download_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT NULL,
  `shop_id` mediumint(8) DEFAULT '0',
  `contact` varchar(20) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `number` varchar(20) DEFAULT '',
  `used` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `clientip` char(15) DEFAULT '0.0.0.0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`download_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 AUTO_INCREMENT=39;

DROP TABLE IF EXISTS jh_shop_fields;
CREATE TABLE `jh_shop_fields` (
  `shop_id` mediumint(8) NOT NULL DEFAULT '0',
  `banner` varchar(150) DEFAULT '',
  `fox` varchar(20) DEFAULT '',
  `mail` varchar(50) DEFAULT '',
  `qq` varchar(50) DEFAULT '',
  `hours` varchar(50) DEFAULT NULL,
  `addr` varchar(255) DEFAULT '',
  `jiaotong` varchar(255) DEFAULT '',
  `bulletin` varchar(255) DEFAULT '',
  `info` mediumtext,
  `psaz` mediumtext,
  `dgxz` mediumtext,
  `skin` varchar(50) DEFAULT '',
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(200) DEFAULT '',
  `seo_description` varchar(200) DEFAULT '',
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_shop_fields VALUES ('1','default/shop_banner.jpg','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','','','','','','','');
INSERT INTO jh_shop_fields VALUES ('2','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','志邦厨柜概述:\n\n感谢历史成就了我们志邦人第16载春秋，今天，我们有幸被国人和同行推举到中国橱柜行业十强，厨卫百强的位置。　　合肥志邦家具销售有限公司成立于1998年，作为中国橱柜行业的先驱，是国内著名的橱柜产品制造基地；集产品研发、生产、销售和多品牌经营的专业化橱柜企业。','','','','','','');
INSERT INTO jh_shop_fields VALUES ('3','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','南京众志开来家具有限公司是一家提供整体橱柜、定制衣柜为主的专业家具企业。公司1998年成立于北京，至今已走过十六年的辉煌历程。公司成立之初就着眼于全国市场，公司快速发展之际，部分骨干人员于2005年南下建立南方总部，目前拥有北京、南京两个生产基地，现公司南北生产厂房面积共三万平米，具备月供货橱柜3500套的生产能力，有公司直属烤漆、膜压工厂。全国已有近三百多家橱柜加盟专卖店，以及北京、太原、南京、杭州、合肥、蚌埠等城市30余家直营店。\n........................................\n................\n.\n开来坚持以质量求生存，为提高管理水平始终作不懈努力。2002年开来与北京清软软件公司共同开发了先进的ERP生产管理系统，全面整合了产、供、销、存储、售后服务等环节。2003年开来同全国重点大学---北京林业大学建立了合作关系，将德国Hettich32mm板式家具生产系统应用到生产过程中，严格执行了板式家具生产工艺标准。并将“品质源于细节”的理念贯穿于整个设计、生产以及售后服务的过程中，优质的产品，优良的服务，赢得顾客的广泛赞誉。\n\n\n 在多方的努力和支持下，开来橱柜先后获得“中国厨卫百强企业”、“全国十大橱柜品牌”“江苏质量诚信AAA级企业”、“中国橱柜出口认证企业”、“十佳网络营销企业”等荣誉接踵而至，。所谓“德国原材 健康开来”，无论从德国环保板材、德国海蒂诗五金、德国西门子电器、德国生产加工设备还是德国厨房设计理念，开来橱柜已经将德国厨房带进了中国，并平均每天都有30多户中国家庭加入开来行列，体验到德国厨房带来的生活乐趣。\n.\n\n\n 2003年10月，开来公司与北京林业大学共同举办了“开来杯”厨卫设计大赛，现已成功举办四届，为企业的产品设计和产品研发提供了有效的技术支持。2006年开来公司先后入选中国家具协会会员单位、中国家具协会厨房专业委员会会员单位、通过ISO9001-2000国际质量管理体系认证。2008年荣获中国厨房委员会理事单位。\n\n 荣耀总是不期而至，但它只属于过去，“开来人”将会以更好的产品，更完善的服务去改善千家万户的烹饪环境和居家环境。致力于为合作伙伴提供便捷、周到的服务。\n.\n.\n\n合肥开来橱柜地址\n一店：瑶海区临泉路信地红星美凯龙二楼 B8010/8015 电话：0551—64250839\n二店：政务区南二环红星美凯龙三楼 C8005电话：0551—65882509','','','','','','');
INSERT INTO jh_shop_fields VALUES ('4','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','&#160;\n伟&#160; 星&#160; 地&#160; 暖\n— 关 爱 有 加&#160;☆ 温 暖 我 家 —\n\n一、伟星地暖简介\n&#160;&#160; 伟星地暖（温暖我家）环境工程有限公司，是一家集地暖销售、设计、安装和售后服务于一体的专业暖通公司。我司审时度势顺应人文发展潮流，博采众长，公司以“健康舒适，安全低碳，完美人性”相结合的独特理念，致力于为广大用户持续打造高品质、高品位的温馨居家环境而不懈努力追求。\n伟星地暖系统\n&#160; 完整稳定、品牌匹配、质量有保障、使用安全放心\n&#160; 责任明确、 无第三方纠纷\n伟星地暖专用管\n&#160; 由中国人民财产保险公司（PICC）承保，质保50年\n伟星地暖施工\n&#160; 施工标准：国家最高标准\n&#160; 施工规范：伟星公司指定专业技术团队，质量稳定\n&#160; 施工设计：设计科学，风格独特，节能高效\n二、伟星地暖服务流程\n1.制定您想装地暖的初步计划，先找到身边的伟星地暖体验中心，详细了解\n2.专业设计人员向西了解您的需求，提供初步建议，提出多样化的初步采暖系统提案\n3.专业人员免费现场勘察和测量，对您的家庭进行综合评估，制作出个性化合理方案\n4.与您的室内设计师商谈，如何与室内装潢搭配\n5.供暖系统体验中心会使用专用合同范本，与您签订销售安装合同\n6.供暖水系统设备及安装人员进场安装设备，并进行试运转\n7.交付隐蔽工程完工报告书，放心享用供暖系统创造的舒适生活\n三、伟星地暖服务优势&#160;','','','','','','');
INSERT INTO jh_shop_fields VALUES ('5','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','','','','','','','');
INSERT INTO jh_shop_fields VALUES ('6','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','【今顶集成吊顶】—仿古吊顶开创者！—以不同，创造不凡！采用符合环保标准的进口板材，融合中国传统厨卫文化和欧洲时尚设计元素，业界独有的“今顶厨卫集成设计系统”为东方家庭量身度制，倾情营造和谐家居。以人为本的设计贯穿于今顶集成吊顶的每一个细节。传承欧式设计最精髓的部分，合肥唯一授权经销商。咨询电话：0551-63521778/ 62918708','','','','','','');
INSERT INTO jh_shop_fields VALUES ('7','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','','','','','','','');
INSERT INTO jh_shop_fields VALUES ('8','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','','','','','','','');
INSERT INTO jh_shop_fields VALUES ('9','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','马丁.路易（意大利）卫浴国际投资有限公司\n\n\n \n\n 马丁·路易（意大利）卫浴国际投资有限公司是一家集设计、开发、生产、销售、服务于一体的陶瓷卫生洁具及其相关配套产品的现代化卫浴国际投资企业。企业具有先进的经营理念，一流专业技术人才，国际领先的生产技术及设备、现代化的生产及质检管理、遍及世界的强大原材料采购网络。早期在2003年以前，马丁路易（MOLO）品牌运营足迹以意大利为主涉入欧洲各地，在2003年，马丁路易高调大力开拓中国市场，携欧洲“精良R26;精确”品质文化、“简约R26;时尚”设计精髓、“奢华R26;优雅”沐浴情怀，全力打造国际知名品牌，销售网络遍布全国各地，并远销欧、美、亚等十多个国家和地区，以代理商、专卖店、办事处、售后服务中心的立体式服务体系为消费者提供优质的产品和高效服务。\n\n企业文化　　“顾客第一、员工第二、股东第三”我们以“顾客第一、员工第二、股东第三”的利他价值观，“做人诚信，做事正义”的行为准则，不断追求“产品优质，服务高效”的经营状态，创造一个顾客满意，员工自豪，股东放心的受人尊敬的学习创新型卫浴企业。\n\n企业使命　　“致力于为国民提供健康、优质、品位的卫浴产品而努力”　　健康卫浴是产品的基础，优质卫浴是生产的追求、品位卫浴是经营的结果。\n\n企业愿望　　“马丁路易，给您一个六星级的家”　　第一层次：消费者由于马丁路易不断的美化卫浴空间，而拥有一个六星级的家；　　第二层次：经销商由于销售马丁路易产品，事业不断发展壮大而拥有一个六星级的家；第三层次：员工与股东由于马丁路易的顾客满意度的不断提高而拥有一个六星级的家；　　马丁路易，给终端消费者、经销商、供应商、员工、股东一个六星级的家。\n企业远景　　我们不断追求成为社会认可、顾客满意，员工自豪，股东放心的受人尊敬的学习创新型现代化卫浴企业。\n经营理念　　诚信正义、优质高效：做人诚信，做事正义、产品优质，服务高效。　　经营姿势理念：　　美化卫浴空间，享受品质生活通过执着与创新，为国民提供健康、优质的卫浴产品，并通过个性化的、专业的设计与服务，不断美化卫浴空间，使国民拥有一个充满尊贵和品位的卫浴空间，不断享受马丁路易创造的个性化私密空间带来的品质生活。 　　市场战略理念：　　优质高效通过生产体系的规范和服务体系的健全，为顾客提供优质的产品和高效的服务。成立产品研发中心，不断研究、开发出个性化的产品；通过对生产体系的研究和规范，不断生产出质量稳定、品质优异的产品；通过人员素质的提高、展厅艺术的研究、物流系统的优化为顾客提供高效的服务。 　　经营体制理念：　　诚信正义诚心诚意实现员工成长与发展、相互信赖的需求，所有员工做人做事充满正气，有情有义。“自由、自主、责任、创新”是员工的工作状，“诚实、信赖、正气、情义”是员工追求的精神。建立短小精干的公司组织，建立人才培养系统，不断追求员工物质和精神两方面的幸福。　　社会性理念：　　顾客第一、员工第二、股东第三顾客第一、员工第二、股东第三，与利益相关者共同发展。引领行业的发展，做卫浴的先锋企业，致力于为国民提供健康、优质、品位的卫浴产品。\n\n品牌影响力　　也正是我们具有了以上的优势，使我们的产品有着巨大的品牌影响力。　　众多同行人士认识它：　　完整的系列，完善的组合，过硬的品质，享誊国内外的知名度，各项国内外品质的认证，使它受到了业内人士的尊敬。　　众多设计师关注它：　　马丁·路易卫浴卓越的设计理念及强大的设计师队伍，使她的产品极具欧陆风情与时尚，“依路”、“豪丹”、“豪玛”、“宝丝” 等系列，更是其风格的集中体现。　　众多高品质楼盘选择它：　　不少业主呼吁要用马丁·路易卫浴，工程商也对马丁·路易卫浴的品牌与品质刮目相看，选择马丁·路易卫浴就是选择放心与实惠。　　众多消费者青睐它：　　“私密空间，我有我选择”，马丁·路易充分体现价值典范，是成功人士的理性选择。\n\n资格证书','','','','','','');
INSERT INTO jh_shop_fields VALUES ('10','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','安徽鑫雅家居科技有限公司--‘MK’国际家居品牌。1948年诞生于欧洲文化艺术中心——意大利，它作为欧洲顶级家居制造商，旗下拥有整体橱柜、整体衣柜、厨房电器等多条国际一流产品体系，是国际综合型现代家居服务提供商。\n\n                        2001年，“MKR26;鑫雅”落户中国。在“MKR26;鑫雅”中国区CEO、安徽鑫雅家居科技有限公司董事长樊亚景先生的带领下，吸纳欧洲文化精髓，融汇民族生活方式，斥巨资注册\"鑫雅\"商标并打造MK（鑫雅厨柜）、MK（鑫雅衣柜）、MK(鑫雅厨电），立足中国打造时尚、温馨、浪漫的MK品牌文化。\n\n                        MKR26;鑫雅橱柜.引进德国豪迈全套数控柔性生产线，产品生产自动化、信息化、精细化，确保每一套橱柜从设计、开料、裁切、表面处理、装配、运输、安装到每一个环节都精益求精，保证产品品质。以其稳定的品质，出色的服务，先后通过ISO9001:2000国际质量管理体系认证，荣膺“中国集成厨房十大品牌”、“中国橱柜十大品牌”、“中国厨卫百强企业”、 “中国著名品牌””、“全国质量放心产品”、“全国质量诚信AAA级品牌企业”等多项国内诸多权威机构颁发的荣誉。\n\n                        MKR26;鑫雅衣柜由意大利著名设计师进行VI形象总策划，其产品品牌定位中高端。凭借着雄厚的实力、尖端的技术和严密的管理。采用性能优异的五金配件和环保优质的板材，引进欧洲先进的生产设备与技术，对家具制作的每个环节精益求精，致力于提供最完美、最优质的产品以及最优秀的服务。\n\n                        迄今为止，安徽鑫雅家居科技有限公司已拥有10万平米的现代化生产园区，全国600多家终端形象店服务中国区域。二期10万平米衣柜、厨电产业园现已破土动工，2012年底将正式投入使用，实力规模已稳居中国整体家居前5强。\n\n\n                        全国统一客服热线：400-887-0805\n\n                        电话&#160;&#160;&#160;&#160;86-0551-64248473       \n\n                        传真&#160;&#160;&#160;&#160;86-0551-63847929\n\n                        Q Q&#160;&#160;&#160;&#160;779894377 \n\n                        邮箱&#160;&#160;&#160;&#160;admin@mkxy.cn\n\n                        地址&#160;&#160;&#160;&#160;安徽省合肥市长丰县岗集镇金岗大道工业&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;二路鑫雅橱柜厂','','','','','','');
INSERT INTO jh_shop_fields VALUES ('11','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','安徽合肥安林商贸有限责任公司位于繁华的五里庙装饰世界，自公司成立以来与多家大、中型装饰公司、家具厂、门厂建立合作关系。凭着一流的信誉和严格的质量让我公司受到广大建筑、公装、家装、家具和门厂企业的一致好评。我公司本着共同发展、互惠互利、携手合作、质量第一的原则，愿与广大装饰企业共创家装新天地。本公司是德华兔宝宝合肥地区总代理，公司现主要代理“万木林”“兔宝宝”“可耐福”等品牌。德华兔宝宝装饰新材股份有限公司创建于1993年，是我国装饰贴面板行业产销规模最大企业.是国内同行业中首家上市公司（股票简称：兔宝宝，股票代码：002043）。 经过十多年不懈努力和创新发展，公司已经发展成为一家室内装饰材料综合供应商，形成了从林木资源的种植抚育和全球采购，到生产板材、地板、木门、五金、油漆涂料胶粘剂等产品系列的完整产业链。产品销售网络覆盖全国各地，并销往美洲、欧洲、澳洲、中东等全球各地。 公司目前已全面通过ISO9001、ISO14001国际质量、环境管理体系认证，中国环境标志产品认证，FSC森林认证，JAS认证、CE认证，CARB认证，荣获中国驰名商标、中国名牌产品称号。公司在环保型装饰材料的研发和市场推广上一直处于国内领先地位，产品达到苛刻的欧洲E0、E1级环保标准。\n 德华兔宝宝装饰新材股份有限公司创建于1993年,经过二十年的不懈努力和创新发展，公司已经从单一的装饰贴面板生产型企业发展成为我国具有较大影响力的室内装饰材料综合服务商，产品销售网络覆盖全国各地，并销往美洲、欧洲、澳洲、中东等全球各地。公司股票于2005年5月10日在深圳证券交易所上市交易（股票简称：兔宝宝，股票代码：002043）。 公司以浙江为主要产业基地，不断优化配置资源，持续稳健对外扩张，在江苏、江西等地已形成一定规模的产业集群，形成了从林木资源的种植抚育和全球采购，到生产和销售各类板材、地板、木门、衣柜、家具、木皮、木百叶、涂料、胶粘剂、装饰五金、墙纸等产品系列的完整产业链。 公司目前已全面通过ISO9001、ISO14001国际质量、环境管理体系认证，中国环境标志产品认证，中国胶合板行业标志性品牌、2008年，“兔宝宝”商标被认定为中国驰名商标，并同时通过了取得FSC&reg;COC产销监管链（Chain of Custody）认证、美国CARB II认证、日本大臣认证等多项国际认证。公司在环保型装饰材料的研发和市场推广上一直处于国内领先地位。 二十年来不断的资源优化组合，使公司的品牌、规模、研发能力、人力资源、原木采购和产品营销网络等在国内同行业中形成明显的领先优势，从而确保了公司业绩的稳步提升。 公司以推进行业绿色进程为己任，积极整合各种优势资源参与全球竞争，倡导绿色消费理念，以高品质、高环保产品为载体，致力于打造中国最具影响力的装饰材料综合服务商，实现由制造业向品牌服务业的转型升级，并努力构建资源优势、创新优势、品牌优势，大力实施六大专卖体系，实现企业跨越式发展。','','','','','','');
INSERT INTO jh_shop_fields VALUES ('12','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','','','','','','','');
INSERT INTO jh_shop_fields VALUES ('13','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','美国凯乐瑞克公司是世界上柔性供暖技术行业的先导者之一，致力于设计、生产、销售世界一流的加热系统。有着三十年生产和营销经验，在为用户供暖问题找到解决方案的同时，仍在不断探究，以确保其产品永远走在质量与技术的最前列。 美国凯乐瑞克公司的服务宗旨是为客户提供全球优良的供暖产品和供暖解决方案，保证每一项产品给我们的客户带来温暖和舒适的享受。 美国凯乐瑞克供暖产品在美国、欧洲、韩国、日本和我国都有广泛的应用，并都已通过UL、Nemko、CE、ETL国家红外线监测中心及北京产品质量监督检验所等权威机构的检测与认证。','','','','','','');
INSERT INTO jh_shop_fields VALUES ('14','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','德国都芳漆是由德国梅菲特工业集团（Meffert AG）生产的系列环保涂料，产品销往欧洲及世界各地。德国都芳漆系列产品是首家进入中国市场，全部以清水稀释的纯环保产品。\n\n所有德国都芳漆的产品，经室内空气检测无一超标。原装进口、无毒无味、当日涂刷、当日入住、连续23年获得了世界最为严格环保标志——“蓝天使”标志，中国十环标志和德国最优产品标志，其产品都全面通过中国权威“十环标志”认证。\n\n\n德国都芳漆是北京奥运村、中华世纪坛和雅典奥运会指定用漆。中南海办公场所、德国大使馆、美国大使馆、北京饭店等一大批的中国知名建筑都选用了德国都芳漆产品。东易日盛装饰、业之峰装饰、龙发装饰、等一大批中国最具实力的装饰企业也纷纷选用了德国都芳漆。而在全国最具影响力的建材卖场如百安居、东方家园、家得宝、居然之家，德国都芳漆也已全面展开深入的合作。辅材北京生态胶水、墙衬等系列产品是鸟巢、国家大剧院、人民大会堂、中央电视台等指定专用产品。','','','','','','');
INSERT INTO jh_shop_fields VALUES ('15','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','本店属于平价销售模式，产品高中低端皆有，主流价格3米墙面安装到位均价约350左右（路程或者时间上不是很方便的客户可提供上门服务，上门会携带专业样本，样板有窗帘效果图和布料质地。）后面会有更详细的报价表上传。。。）','','','','','','');
INSERT INTO jh_shop_fields VALUES ('16','','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','科天水性漆简介 \n 科天水性漆由合肥市科天化工有限公司生产。公司位于合肥市桃花工业开发区，厂区面积67亩。是专业从事水性聚氨酯研究、生产和销售为一体的高科技公司，公司与中国科技大学和安徽大学进行产、学、研合作，建立了“科大—科天水性高分子新材料联合研究中心”和“安大—科天水性高分子联合实验室”。获得国家发明专利7项，省级新产品3项。研发、制备出品质优异的水性聚氨酯木器漆，被誉为中国健康漆、水性漆、环保漆十大品牌之一，并且顺利通过中国十环认证，通过欧洲安全标准“SGS”的检测，产品用于国内的家庭装修和出口家具、木器玩具上，受到广大业主和欧美等国家客商地欢迎。 \n 同时，科天水性漆也得到政府地大力支持，获得2008——2011年度安徽省科技厅科技型中小企业创新基金项目、安徽省发改委技改专项资金项目。 \n 目前市场上的木器漆多数是传统的油性漆，油漆包装必须成三组分，内有三种成分：漆、稀释剂、固化剂。其中稀释剂（称“天那水”也称“香蕉水”）的作用是用来溶解漆的，固化剂是促使漆快速干燥固化。这两种助剂都会有刺鼻的气味，含有甲醛、苯等有毒致癌溶剂。而且，油漆中的游离TDI在长达５年的时间内都会不断散发，严重的危害人们的健康。 \n 科天水性漆特点是：用自来水作为稀释剂，替代油性漆中剧毒有害的固化剂和天那水（稀释剂），不含甲醛、苯、TDI致癌物质和重金属等有害剧毒物质，漆膜丰润、耐水耐热（用100度的开水烫而不发白）、耐寒（在0℃以上的条件下都可以施工），无毒无味，真正实现“当天涂刷当天入住”。','','','','','','');
INSERT INTO jh_shop_fields VALUES ('17','demo/photo/201502/20150215_5348EEE9E4FD4864828ABFC9DF988C7C.jpg','','','800070067','','合肥市新站区站北文化广场正鼎国际商务港2302','','','天猫商城品质商家\r\n经营销售广东东居/Happyiness District品牌\r\n地中海、美式田园、简欧风格沙发，软床，松木家具、立体浮雕软包硬包衣柜移门等家具\r\n天猫商城或者淘宝网搜索：粤鑫家居专营店\r\n合肥实体店地址：\r\n安徽省合肥市瑶海区当涂北路信达格兰云天花园小区12#楼104商铺，\r\n电话：0551-64374507, &nbsp;18949828343&nbsp;&nbsp; 15375433101','','','','','','');
DROP TABLE IF EXISTS jh_shop_mendian;
CREATE TABLE `jh_shop_mendian` (
  `mendian_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) DEFAULT '0',
  `title` varchar(150) DEFAULT '',
  `desc` varchar(255) DEFAULT NULL,
  `thumb` varchar(150) DEFAULT NULL,
  `addr` varchar(150) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `content` mediumtext,
  `views` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`mendian_id`),
  KEY `shop_id` (`shop_id`,`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18;

DROP TABLE IF EXISTS jh_shop_money;
CREATE TABLE `jh_shop_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `log` varchar(200) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;

DROP TABLE IF EXISTS jh_shop_news;
CREATE TABLE `jh_shop_news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT NULL,
  `shop_id` mediumint(8) DEFAULT '0',
  `from` enum('news','active') DEFAULT 'news',
  `title` varchar(150) DEFAULT '',
  `content` mediumtext,
  `views` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`news_id`),
  KEY `shop_id` (`shop_id`,`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_shop_pay;
CREATE TABLE `jh_shop_pay` (
  `shop_id` mediumint(8) NOT NULL,
  `thumb` varchar(150) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `stime` int(10) DEFAULT NULL,
  `ltime` int(10) DEFAULT NULL,
  `order` int(10) DEFAULT '0',
  `num` int(5) DEFAULT '0',
  `order_by` int(5) DEFAULT '50',
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_shop_service;
CREATE TABLE `jh_shop_service` (
  `shop_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `zhizhao` enum('Y','N') DEFAULT 'N',
  `A` enum('Y','N') DEFAULT 'N',
  `B` enum('Y','N') DEFAULT 'N',
  `C` enum('Y','N') DEFAULT 'N',
  `D` enum('Y','N') DEFAULT 'N',
  `E` enum('Y','N') DEFAULT 'N',
  `F` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_shop_vcate;
CREATE TABLE `jh_shop_vcate` (
  `vcat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` mediumint(8) DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`vcat_id`),
  KEY `shop_id` (`shop_id`,`orderby`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 AUTO_INCREMENT=62;

DROP TABLE IF EXISTS jh_shop_yuyue;
CREATE TABLE `jh_shop_yuyue` (
  `yuyue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` mediumint(8) DEFAULT '0',
  `product_id` int(10) DEFAULT '0',
  `contact` varchar(20) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `address` varchar(150) DEFAULT '',
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`yuyue_id`),
  KEY `__INDEX` (`uid`,`shop_id`,`status`,`dateline`,`city_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22;

DROP TABLE IF EXISTS jh_sms_log;
CREATE TABLE `jh_sms_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(50) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `sms` varchar(20) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `clientip` char(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=658 DEFAULT CHARSET=utf8 AUTO_INCREMENT=658;

DROP TABLE IF EXISTS jh_supervist;
CREATE TABLE `jh_supervist` (
  `supervist_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `area_id` smallint(6) DEFAULT NULL,
  `name` varchar(50) DEFAULT '',
  `qq` varchar(15) DEFAULT '',
  `thumb` varchar(150) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT '',
  `views` mediumint(8) DEFAULT '0',
  `about` mediumtext,
  `orderby` smallint(6) DEFAULT '50',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`supervist_id`),
  KEY `__INDEX` (`city_id`,`closed`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 AUTO_INCREMENT=223;

DROP TABLE IF EXISTS jh_supervist_attr;
CREATE TABLE `jh_supervist_attr` (
  `supervist_id` mediumint(8) NOT NULL DEFAULT '0',
  `attr_id` smallint(6) DEFAULT '0',
  `attr_value_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`supervist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_system_config;
CREATE TABLE `jh_system_config` (
  `k` varchar(30) NOT NULL,
  `v` mediumtext,
  `title` varchar(30) DEFAULT '',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO jh_system_config VALUES ('attach','a:19:{s:3:\"dir\";s:9:\"./attachs\";s:3:\"url\";s:9:\"./attachs\";s:10:\"allow_exts\";s:16:\"jpg,gif,png,jpeg\";s:10:\"allow_size\";s:4:\"2048\";s:13:\"watermarktype\";s:0:\"\";s:13:\"watermarktext\";a:4:{s:4:\"font\";s:8:\"cyzt.ttf\";s:4:\"size\";s:2:\"14\";s:5:\"color\";s:7:\"#000000\";s:4:\"text\";s:7:\"@{name}\";}s:15:\"watermarkstatus\";s:1:\"9\";s:16:\"watermarkquality\";s:2:\"90\";s:12:\"thumbquality\";s:2:\"90\";s:5:\"thumb\";s:3:\"200\";s:4:\"site\";a:1:{s:5:\"photo\";s:3:\"200\";}s:6:\"youhui\";a:1:{s:5:\"photo\";s:7:\"428X200\";}s:5:\"diary\";a:1:{s:5:\"photo\";s:3:\"200\";}s:7:\"company\";a:2:{s:4:\"logo\";s:7:\"200X100\";s:5:\"thumb\";s:7:\"300X300\";}s:4:\"shop\";a:2:{s:4:\"logo\";s:7:\"200X100\";s:5:\"thumb\";s:7:\"200X200\";}s:8:\"homepics\";a:3:{s:5:\"photo\";s:3:\"750\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"360\";}s:9:\"casephoto\";a:4:{s:5:\"photo\";s:3:\"720\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"360\";s:5:\"small\";s:5:\"60X60\";}s:7:\"product\";a:4:{s:5:\"photo\";s:3:\"720\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"360\";s:5:\"small\";s:5:\"60X60\";}s:6:\"editor\";a:3:{s:5:\"photo\";s:3:\"750\";s:9:\"watermark\";s:1:\"1\";s:5:\"thumb\";s:3:\"360\";}}','附件设置','1423884350');
INSERT INTO jh_system_config VALUES ('booking','a:2:{s:8:\"max_look\";s:1:\"5\";s:9:\"look_gold\";s:3:\"200\";}','预约设置','1382086167');
INSERT INTO jh_system_config VALUES ('bulletin','a:6:{s:11:\"open_member\";s:1:\"1\";s:6:\"member\";s:0:\"\";s:12:\"open_company\";s:1:\"1\";s:7:\"company\";s:0:\"\";s:9:\"open_shop\";s:1:\"0\";s:4:\"shop\";s:0:\"\";}','公告管理','1404116190');
INSERT INTO jh_system_config VALUES ('config','a:2:{s:4:\"hash\";s:8360:\"6956424F5277304B47676F414141414E535568455567414141483041414141744341594141414344446D545341414141475852465748525462325A30643246795A5142425A4739695A53424A6257466E5A564A6C5957523563636C6C5041414141794270564668305745314D4F6D4E76625335685A4739695A53353462584141414141414144772F654842685932746C644342695A576470626A30693737752F496942705A443069567A564E4D4531775132566F61556836636D5654656B355559337072597A6C6B496A382B494478344F6E68746347316C6447456765473173626E4D366544306959575276596D5536626E4D366257563059533869494867366547317764477339496B466B62324A6C4946684E5543424462334A6C494455754D43316A4D445977494459784C6A457A4E4463334E7977674D6A41784D4338774D6938784D6930784E7A6F7A4D6A6F774D4341674943416749434167496A346750484A6B5A6A70535245596765473173626E4D36636D526D50534A6F644852774F693876643364334C6E637A4C6D39795A7938784F546B354C7A41794C7A49794C584A6B5A69317A6557353059586774626E4D6A496A346750484A6B5A6A70455A584E6A636D6C7764476C76626942795A47593659574A76645851394969496765473173626E4D366547317750534A6F644852774F693876626E4D7559575276596D5575593239744C336868634338784C6A41764969423462577875637A70346258424E545430696148523063446F764C32357A4C6D466B62324A6C4C6D4E7662533934595841764D5334774C3231744C79496765473173626E4D36633352535A575939496D6830644841364C793975637935685A4739695A53356A62323076654746774C7A45754D43397A56486C775A5339535A584E7664584A6A5A564A6C5A694D694948687463447044636D566864473979564739766244306951575276596D5567554768766447397A6147397749454E544E5342586157356B6233647A496942346258424E5454704A626E4E305957356A5A556C4550534A346258417561576C6B4F6B55334D3055784E5459354D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496942346258424E5454704562324E316257567564456C4550534A34625841755A476C6B4F6B55334D3055784E545A424D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496A3467504868746345314E4F6B526C636D6C325A575247636D397449484E30556D566D4F6D6C7563335268626D4E6C53555139496E687463433570615751365254637A525445314E6A63774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D6949484E30556D566D4F6D5276593356745A57353053555139496E68746343356B615751365254637A525445314E6A67774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D694C7A3467504339795A4759365247567A59334A70634852706232342B49447776636D526D4F6C4A45526A3467504339344F6E68746347316C6447452B4944772F654842685932746C6443426C626D5139496E4969507A3637555966634141414973306C455156523432757963435778555652534737394253704341574B6367715167566B4559774C6771675246526663514E77696F6B614A476F4F4345414B4B454E53344C776949714B43345339474943305A6C55304645525648454254634552634343624E307330426E50795879547555376554476435725A33704F386B665A715A33376E74392F7A336E2F4F666357337942514D4234567265736E766349504E493971774F5737665468707930364C704A2F7567744B424B483466364267676D424F457466704C356774714C546D79784E4D45647A482B317A42564D4641727175574A64677347437A34323658662B5148426C594C6476506478543663497471517A6D58324B316964504F6F53336376673850386E37306539316450693870665736767143396F4858456D4F61434269343946795734726541515946754475754C7030634C376E69696637302F794F6E756A6646345A4D66632B687A4737557268757041556972686B7966355450367854705070657645306A524F394D3566576F61797947534A4B4B686369496963564E425A794B692B7A6E64737971745144444D656E34484343714961493073687970414F3477426D6C71755A6B777246725366434A654E686A466F69387346707775755A5137564F6A634A7A6955715855737139494F66304530653664566B536C4B7834414C4262344C56676D50514A4F3944666E394536445245714936355158417933766F59337277586B56784247744D46385A54674C6347744546384D3259634C68677132436B594B31676932735A412B396B69765874744346644F485A2F6763336A684F734A44586C776B32436A62786E666459454630456379464E506251584663564D5153454C5142665348337A6E43464A45415A4867524261514C6F345A6771386850653677373547656E4A306D6D43676F6F3953635473376542664768614B4135654A35674F4A4667752B424651536D457170587A37317242523959312B754C397A374D414E4C5350596E354E4854634B7A684A305A66772F48756E56613430463751526E514C6147315256346279346575524E767635586E6E45756531716A776854565845367350596C734A65587768704A636A695064772F517036437A7572714A4138306C32796475545338594B444254305156354E3570714671705A6D675348437334485842434D4751434E49445553716364594950436576614E376D436E6F55756F70645A57453879626F6B6C4944335371386D576B713956694E30702B453777454747335067547551356A5651316D586F514F614A4341575A3050305145546934344B4C5341586C7A4E553030624C59497A303557774D47556A6239535A342F694964665A676D725279444A494D4B557141666A764D346F7776347977537242766554362B6F542F3639415242703251556E5047733672744A4254336C3552515778427068586A34554A523371655667787A4457746C416E30422F78755771464671687A5031476C6B516E7646655251447437442B4E784D496A3151432B63376E5470374A74366D684A354E6E6A3059676155352F427A4272337A6E65484C384E31616E7271455645587A776B516668756C665267667A7649304963537268767866632B45587A5039373253725970636D597070447531484C746664794A6155583770622B424C50564A73793879476E495648675849685A5338672F6A43695154376C316965426F76486B444B554A562B6C6551337078726170672F4370337743796B6A4951644F42394C56632B36694A4D6C4B5952342F586E35696976657A682F745251716579434A5338682F464B62636B6542346B5863392B6643546F4A6E6F5845504479336B6B553446652F4F73577075726345585543573853636374744F6855775539423155394135622B61536151334A6F54574671753069486D47686F7432335971744D51735164666C34614448452F5955487678584864565A796A5A416D4B4C49453233693067597249735A527432377A775876326D2F66546C4D58362B472F7961355078626F337865616932457A53416838306833787A547474454773395351482B2F432B5A6554666B67546E31507A666D547A666C66546B4939392F79707756796478734F704475783674533356635057436F3478385837302F7738686B35625163546341547A324D334C77736A6A6E624D2B633535746739363965784A792F6D324158376C4772423542527043766877784651716478764A62684E634B5A4C3936596B7A7A4C42625653316E386E6E4A64787244387137515361344933647A48494A4C782B6E57367047385830325673426552714C582B71594A7271434B4757794976593067764A357756755454664D4A666D3055375A45784375432F4A75453978523232434E30584B744E2B57636B6A6B643062637978694A365774414E62353473654463697636757748574343323746643642634D5355513770454E7A7875336A556765344E4D38497646684C726B6D51734D46687758364556796F706568687A5A49773578304C344473624E635242304A66514164477456643968363862706A4A70466547303037613166772B6732384C5A62394948694E31307071573463783355674461724F5A4E35597449712B7261542F2B6C4E6F57336E305A527271325634394149377874346A744A4F34327846535A38357436327755534362656943654777636A5A31792B675731697653444D6F7A30546B544A55506B556A315656552F65306F734B33636336354869526B4E5258656D325559366145393742304F6554775A613244432B2B786254666730544C5659545A462B574977794B74314D6857432B31554E77347738783871786F754C2B3666344761494C304A3559715437557044306A556E6C3771735638704E2B49436B79515453727A6242566D4B6B3653624539326C49656F4377486C7251725632596334384A2F796D5A6274446B70697670326F3638586E4248464D476F4175547A4E4D3370577932437569547776577A6746423143352B50316F455337424B71696248697339332B51376D4F46366731664B486A424250764E655648477A7A644A37424456456C744F616455306766705939396631464B73656F476A7638504F6C704137645A446B687A6A6E314C487768356542464E5647797153635070337A52666439474E42303649647761782F6975486A61596C51626B617175314F7753764E2B476A567039547170316E676D31645863437234346836326A50586B374F5448635973354764484D3361523566314F316F5A783274545263335172616F4A304C544F754D73486563694B6D44334253476E693552693039665871704352353348686E7859505641596A385450707173326D56646C416734326F6F494C31716177445956682F634C586A48424C567074757478676E413948364C314E685042396647392B545A44754E346B664D7452636549734A62694C556468764751382B69524E4E652B306F54507257716E71363938686D51744A685157326A436634335346636359514370645243694F5A7270686F7A747A453069522B6C722F4975596436376F614366516B55562F65617871646D3867766C6831446F6361725A4F4E644942712B376A54526435685376556171696A7A534F70762F6E736C7235694441394C6855475637664159386537544458667367627A2F6859707566766444763564753768627542552F6378454B42733353473855682F4372536A4671324E6B4F79664D67665763566F6A4972536A5045546348704E466557772B63616A6654736575692F4B666B71536A4E704C6C36764278354F516F5346446C4C6F6D6267503850444663524165656D355447542B492B5871623843455131526136632F63323139336E46756D62574E6E466C68646F54567269554B2B57574D304B502B383349745A556B61364B73776E6A5A373479457A356B4744704F3747626E626A6371655A655663774D4F6E62416C654A76757076316F676E766830577744595675397552574C794D647A325779534F39623048564165576C7233716F35545A4649347975337A2F765041756D666566727048756D6365365A356C705030727741444766685A7833374E41374141414141424A52553545726B4A6767673D3D\";s:4:\"host\";s:132:\"687474703A2F2F77777725732E696A682E63632F696E6465782E7068703F63746C3D6C697374656E26686F73743D2573266B65793D25732676657273696F6E3D2573\";}','系统设置','');
INSERT INTO jh_system_config VALUES ('mail','a:4:{s:6:\"sender\";s:15:\"ijhmail@126.com\";s:4:\"mode\";s:4:\"smtp\";s:4:\"smtp\";a:4:{s:4:\"host\";s:12:\"smtp.126.com\";s:4:\"port\";s:2:\"25\";s:5:\"uname\";s:15:\"ijhmail@126.com\";s:6:\"passwd\";s:8:\"ijianghu\";}s:5:\"email\";s:15:\"ijianghu@qq.com\";}','邮件设置','1410881223');
INSERT INTO jh_system_config VALUES ('site','a:19:{s:5:\"title\";s:24:\"江湖家居门户系统\";s:7:\"siteurl\";s:29:\"http://850196412.ijianghu.net\";s:6:\"secret\";s:43:\"Y2M0NWExZWFjYjE1OGI4ZTI5YTI1OWY2ZTZhOTJiMjU\";s:4:\"mail\";s:15:\"ijianghu@qq.com\";s:4:\"kfqq\";s:9:\"800070067\";s:5:\"phone\";s:13:\"0551-64278115\";s:4:\"logo\";s:58:\"photo/201611/20161130_B3493770BCAA7BE60E6DE729D2EB4C0B.jpg\";s:8:\"weixinqr\";s:0:\"\";s:6:\"mobile\";s:1:\"0\";s:7:\"ucenter\";s:1:\"0\";s:7:\"rewrite\";s:1:\"0\";s:7:\"city_id\";s:1:\"7\";s:10:\"multi_city\";s:1:\"0\";s:6:\"domain\";s:0:\"\";s:11:\"first_index\";s:4:\"city\";s:6:\"topics\";s:0:\"\";s:5:\"intro\";s:309:\"江湖家居经历了一年半的发展从原先不了解这个行业到做出最适合这个行业营销的平台，江 湖是一直实事求是的和站长站在统一战线！2014年是垂直行业互联网创业的最佳年份 ，那么江湖家居无疑是家居垂直领域最适合站长的O2O系统！\";s:6:\"tongji\";s:0:\"\";s:3:\"icp\";s:20:\"皖ICP备13010842号\";}','基本设置','1480495535');
INSERT INTO jh_system_config VALUES ('sms','a:6:{s:10:\"show_error\";s:1:\"1\";s:5:\"comid\";s:4:\"2000\";s:9:\"smsnumber\";s:5:\"10690\";s:5:\"uname\";s:8:\"ijianghu\";s:6:\"passwd\";s:8:\"********\";s:6:\"mobile\";s:0:\"\";}','短信设置','1406017143');
INSERT INTO jh_system_config VALUES ('connect','a:6:{s:10:\"qq_is_open\";s:1:\"1\";s:9:\"qq_app_id\";s:9:\"101009951\";s:10:\"qq_app_key\";s:32:\"9a9ba77d0b94ad7411f33ddc2f0583ae\";s:13:\"weibo_is_open\";s:1:\"1\";s:12:\"weibo_app_id\";s:10:\"2678015260\";s:13:\"weibo_app_key\";s:32:\"6027ec8dfd5446af22513d768d7043d7\";}','账号互联','1390373361');
INSERT INTO jh_system_config VALUES ('site_config','a:2:{s:4:\"hash\";s:8360:\"6956424F5277304B47676F414141414E535568455567414141483041414141744341594141414344446D545341414141475852465748525462325A30643246795A5142425A4739695A53424A6257466E5A564A6C5957523563636C6C5041414141794270564668305745314D4F6D4E76625335685A4739695A53353462584141414141414144772F654842685932746C644342695A576470626A30693737752F496942705A443069567A564E4D4531775132566F61556836636D5654656B355559337072597A6C6B496A382B494478344F6E68746347316C6447456765473173626E4D366544306959575276596D5536626E4D366257563059533869494867366547317764477339496B466B62324A6C4946684E5543424462334A6C494455754D43316A4D445977494459784C6A457A4E4463334E7977674D6A41784D4338774D6938784D6930784E7A6F7A4D6A6F774D4341674943416749434167496A346750484A6B5A6A70535245596765473173626E4D36636D526D50534A6F644852774F693876643364334C6E637A4C6D39795A7938784F546B354C7A41794C7A49794C584A6B5A69317A6557353059586774626E4D6A496A346750484A6B5A6A70455A584E6A636D6C7764476C76626942795A47593659574A76645851394969496765473173626E4D366547317750534A6F644852774F693876626E4D7559575276596D5575593239744C336868634338784C6A41764969423462577875637A70346258424E545430696148523063446F764C32357A4C6D466B62324A6C4C6D4E7662533934595841764D5334774C3231744C79496765473173626E4D36633352535A575939496D6830644841364C793975637935685A4739695A53356A62323076654746774C7A45754D43397A56486C775A5339535A584E7664584A6A5A564A6C5A694D694948687463447044636D566864473979564739766244306951575276596D5567554768766447397A6147397749454E544E5342586157356B6233647A496942346258424E5454704A626E4E305957356A5A556C4550534A346258417561576C6B4F6B55334D3055784E5459354D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496942346258424E5454704562324E316257567564456C4550534A34625841755A476C6B4F6B55334D3055784E545A424D4449314D7A457852544D344D554933516A46475154597A4D304E474E54597A496A3467504868746345314E4F6B526C636D6C325A575247636D397449484E30556D566D4F6D6C7563335268626D4E6C53555139496E687463433570615751365254637A525445314E6A63774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D6949484E30556D566D4F6D5276593356745A57353053555139496E68746343356B615751365254637A525445314E6A67774D6A557A4D5446464D7A6778516A64434D555A424E6A4D7A513059314E6A4D694C7A3467504339795A4759365247567A59334A70634852706232342B49447776636D526D4F6C4A45526A3467504339344F6E68746347316C6447452B4944772F654842685932746C6443426C626D5139496E4969507A3637555966634141414973306C455156523432757963435778555652534737394253704341574B6367715167566B4559774C6771675246526663514E77696F6B614A476F4F4345414B4B454E53344C776949714B43345339474943305A6C55304645525648454254634552634343624E307330426E50795879547555376554476435725A33704F386B665A715A33376E74392F7A336E2F4F666357337942514D4234567265736E766349504E493971774F5737665468707930364C704A2F7567744B424B483466364267676D424F457466704C356774714C546D79784E4D45647A482B317A42564D4641727175574A64677347437A34323658662B5148426C594C6476506478543663497471517A6D58324B316964504F6F53336376673850386E37306539316450693870665736767143396F4858456D4F61434269343946795734726541515946754475754C7030634C376E69696637302F794F6E756A6646345A4D66632B687A4737557268757041556972686B7966355450367854705070657645306A524F394D3566576F61797947534A4B4B686369496963564E425A794B692B7A6E64737971745144444D656E34484343714961493073687970414F3477426D6C71755A6B777246725366434A654E686A466F69387346707775755A5137564F6A634A7A6955715855737139494F66304530653664566B536C4B7834414C4262344C56676D50514A4F3944666E394536445245714936355158417933766F59337277586B56784247744D46385A54674C6347744546384D3259634C68677132436B594B31676932735A412B396B69765874744346644F485A2F6763336A684F734A44586C776B32436A62786E666459454630456379464E506251584663564D5153454C5142665348337A6E43464A45415A4867524261514C6F345A6771386850653677373547656E4A306D6D43676F6F3953635473376542664768614B4135654A35674F4A4667752B424651536D457170587A37317242523959312B754C397A374D414E4C5350596E354E4854634B7A684A305A66772F48756E56613430463751526E514C6147315256346279346575524E767635586E6E45756531716A776854565845367350596C734A65587768704A636A695064772F517036437A7572714A4138306C32796475545338594B444254305156354E3570714671705A6D675348437334485842434D4751434E49445553716364594950436576614E376D436E6F55756F70645A57453879626F6B6C4944335371386D576B713956694E30702B453777454747335067547551356A5651316D586F514F614A4341575A3050305145546934344B4C5341586C7A4E553030624C59497A303557774D47556A6239535A342F694964665A676D725279444A494D4B557141666A764D346F7776347977537242766554362B6F542F3639415242703251556E5047733672744A4254336C3552515778427068586A34554A523371655667787A4457746C416E30422F78755771464671687A5031476C6B516E7646655251447437442B4E784D496A3151432B63376E5470374A74366D684A354E6E6A3059676155352F427A4272337A6E65484C384E31616E7271455645587A776B516668756C665267667A7649304963537268767866632B45587A5039373253725970636D597070447531484C746664794A6155583770622B424C50564A73793879476E495648675849685A5338672F6A43695154376C316965426F76486B444B554A562B6C6551337078726170672F4370337743796B6A4951644F42394C56632B36694A4D6C4B5952342F586E35696976657A682F745251716579434A5338682F464B62636B6542346B5863392B6643546F4A6E6F5845504479336B6B553446652F4F73577075726345585543573853636374744F6855775539423155394135622B61536151334A6F54574671753069486D47686F7432335971744D51735164666C34614448452F5955487678584864565A796A5A416D4B4C49453233693067597249735A527432377A775876326D2F66546C4D58362B472F7961355078626F337865616932457A53416838306833787A547474454773395351482B2F432B5A6554666B67546E31507A666D547A666C66546B4939392F79707756796478734F704475783674533356635057436F3478385837302F7738686B35625163546341547A324D334C77736A6A6E624D2B633535746739363965784A792F6D324158376C4772423542527043766877784651716478764A62684E634B5A4C3936596B7A7A4C42625653316E386E6E4A64787244387137515361344933647A48494A4C782B6E57367047385830325673426552714C582B71594A7271434B4757794976593067764A357756755454664D4A666D3055375A45784375432F4A75453978523232434E30584B744E2B57636B6A6B643062637978694A365774414E62353473654463697636757748574343323746643642634D5355513770454E7A7875336A556765344E4D38497646684C726B6D51734D46687758364556796F706568687A5A49773578304C344473624E635242304A66514164477456643968363862706A4A70466547303037613166772B6732384C5A62394948694E31307071573463783355674461724F5A4E35597449712B7261542F2B6C4E6F57336E305A527271325634394149377874346A744A4F34327846535A38357436327755534362656943654777636A5A31792B675731697653444D6F7A30546B544A55506B556A315656552F65306F734B33636336354869526B4E5258656D325559366145393742304F6554775A613244432B2B786254666730544C5659545A462B574977794B74314D6857432B31554E77347738783871786F754C2B3666344761494C304A3559715437557044306A556E6C3771735638704E2B49436B79515453727A6242566D4B6B3653624539326C49656F4377486C7251725632596334384A2F796D5A6274446B70697670326F3638586E4248464D476F4175547A4E4D3370577932437569547776577A6746423143352B50316F455337424B71696248697339332B51376D4F46366731664B486A424250764E655648477A7A644A37424456456C744F616455306766705939396631464B73656F476A7638504F6C704137645A446B687A6A6E314C487768356542464E5647797153635070337A52666439474E42303649647761782F6975486A61596C51626B617175314F7753764E2B476A567039547170316E676D31645863437234346836326A50586B374F5448635973354764484D3361523566314F316F5A783274545263335172616F4A304C544F754D73486563694B6D44334253476E693552693039665871704352353348686E7859505641596A385450707173326D56646C416734326F6F494C31716177445956682F634C586A48424C567074757478676E413948364C314E685042396647392B545A44754E346B664D7452636549734A62694C556468764751382B69524E4E652B306F54507257716E71363938686D51744A685157326A436634335346636359514370645243694F5A7270686F7A747A453069522B6C722F4975596436376F614366516B55562F65617871646D3867766C6831446F6361725A4F4E644942712B376A54526435685376556171696A7A534F70762F6E736C7235694441394C6855475637664159386537544458667367627A2F6859707566766444763564753768627542552F6378454B42733353473855682F4372536A4671324E6B4F79664D67665763566F6A4972536A5045546348704E466557772B63616A6654736575692F4B666B71536A4E704C6C36764278354F516F5346446C4C6F6D6267503850444663524165656D355447542B492B5871623843455131526136632F63323139336E46756D62574E6E466C68646F54567269554B2B57574D304B502B383349745A556B61364B73776E6A5A373479457A356B4744704F3747626E626A6371655A655663774D4F6E62416C654A76757076316F676E766830577744595675397552574C794D647A325779534F39623048564165576C7233716F35545A4649347975337A2F765041756D666566727048756D6365365A356C705030727741444766685A7833374E41374141414141424A52553545726B4A6767673D3D\";s:4:\"host\";s:114:\"687474703A2F2F7777772E696A682E63632F696E6465782E7068703F63746C3D6D6F6E69746F72696E6726686F73743D2573266B65793D2573\";}','配置设置','1389324222');
INSERT INTO jh_system_config VALUES ('locoyspider','a:4:{s:9:\"Authorize\";s:14:\"XFxDEZpbGb21tm\";s:6:\"isopen\";s:1:\"0\";s:9:\"Autothumb\";s:1:\"1\";s:9:\"Loadimage\";s:1:\"1\";}','火车头采集','1403262374');
INSERT INTO jh_system_config VALUES ('score','a:3:{s:7:\"company\";a:5:{s:6:\"score1\";s:6:\"服务\";s:6:\"score2\";s:6:\"价格\";s:6:\"score3\";s:6:\"设计\";s:6:\"score4\";s:6:\"施工\";s:6:\"score5\";s:6:\"售后\";}s:8:\"designer\";a:3:{s:6:\"score1\";s:6:\"设计\";s:6:\"score2\";s:6:\"服务\";s:6:\"score3\";s:6:\"贴心\";}s:2:\"gz\";a:3:{s:6:\"score1\";s:6:\"施工\";s:6:\"score2\";s:6:\"服务\";s:6:\"score3\";s:6:\"贴心\";}}','评论配置','1414511280');
INSERT INTO jh_system_config VALUES ('integral','a:13:{s:4:\"case\";s:1:\"1\";s:4:\"site\";s:1:\"1\";s:3:\"ask\";s:1:\"1\";s:6:\"answer\";s:1:\"1\";s:6:\"youhui\";s:3:\"-10\";s:6:\"coupon\";s:3:\"-10\";s:13:\"certification\";s:2:\"10\";s:7:\"product\";s:1:\"1\";s:5:\"email\";s:2:\"10\";s:6:\"mobile\";s:2:\"10\";s:4:\"gold\";s:3:\"-10\";s:5:\"diary\";s:1:\"1\";s:4:\"news\";s:1:\"1\";}','积分设置','1423810997');
INSERT INTO jh_system_config VALUES ('audit','a:147:{s:12:\"ask_member_N\";s:1:\"0\";s:12:\"ask_member_Y\";s:1:\"1\";s:15:\"answer_member_N\";s:1:\"0\";s:15:\"answer_member_Y\";s:1:\"1\";s:14:\"diary_member_N\";s:1:\"0\";s:14:\"diary_member_Y\";s:1:\"1\";s:17:\"dianping_member_N\";s:1:\"0\";s:17:\"dianping_member_Y\";s:1:\"1\";s:20:\"caseComment_member_N\";s:1:\"0\";s:20:\"caseComment_member_Y\";s:1:\"1\";s:21:\"diaryComment_member_N\";s:1:\"0\";s:21:\"diaryComment_member_Y\";s:1:\"1\";s:23:\"productComment_member_N\";s:1:\"1\";s:23:\"productComment_member_Y\";s:1:\"1\";s:20:\"shopComment_member_N\";s:1:\"1\";s:20:\"shopComment_member_Y\";s:1:\"1\";s:16:\"yuyue_designer_N\";s:2:\"-1\";s:16:\"yuyue_designer_Y\";s:1:\"0\";s:15:\"case_designer_N\";s:1:\"0\";s:15:\"case_designer_Y\";s:1:\"1\";s:14:\"ask_designer_N\";s:1:\"0\";s:14:\"ask_designer_Y\";s:1:\"1\";s:17:\"answer_designer_N\";s:1:\"0\";s:17:\"answer_designer_Y\";s:1:\"1\";s:16:\"diary_designer_N\";s:1:\"0\";s:16:\"diary_designer_Y\";s:1:\"1\";s:22:\"caseComment_designer_N\";s:1:\"0\";s:22:\"caseComment_designer_Y\";s:1:\"1\";s:23:\"diaryComment_designer_N\";s:1:\"0\";s:23:\"diaryComment_designer_Y\";s:1:\"1\";s:25:\"productComment_designer_N\";s:1:\"0\";s:25:\"productComment_designer_Y\";s:1:\"1\";s:18:\"tenders_designer_N\";s:1:\"0\";s:18:\"tenders_designer_Y\";s:1:\"1\";s:22:\"shopComment_designer_N\";s:1:\"0\";s:22:\"shopComment_designer_Y\";s:1:\"1\";s:16:\"yuyue_mechanic_N\";s:2:\"-1\";s:16:\"yuyue_mechanic_Y\";s:1:\"0\";s:15:\"case_mechanic_N\";s:1:\"0\";s:15:\"case_mechanic_Y\";s:1:\"0\";s:14:\"ask_mechanic_N\";s:1:\"0\";s:14:\"ask_mechanic_Y\";s:1:\"0\";s:17:\"answer_mechanic_N\";s:1:\"0\";s:17:\"answer_mechanic_Y\";s:1:\"0\";s:16:\"diary_mechanic_N\";s:1:\"0\";s:16:\"diary_mechanic_Y\";s:1:\"0\";s:22:\"caseComment_mechanic_N\";s:1:\"0\";s:22:\"caseComment_mechanic_Y\";s:1:\"0\";s:23:\"diaryComment_mechanic_N\";s:1:\"0\";s:23:\"diaryComment_mechanic_Y\";s:1:\"0\";s:25:\"productComment_mechanic_N\";s:1:\"0\";s:25:\"productComment_mechanic_Y\";s:1:\"0\";s:22:\"shopComment_mechanic_N\";s:1:\"0\";s:22:\"shopComment_mechanic_Y\";s:1:\"0\";s:17:\"tenders_company_N\";s:2:\"-1\";s:17:\"tenders_company_Y\";s:1:\"1\";s:17:\"tenders_company_V\";s:1:\"1\";s:15:\"yuyue_company_N\";s:2:\"-1\";s:15:\"yuyue_company_Y\";s:2:\"-1\";s:15:\"yuyue_company_V\";s:1:\"1\";s:14:\"skin_company_N\";s:1:\"1\";s:14:\"skin_company_Y\";s:1:\"1\";s:14:\"skin_company_V\";s:1:\"1\";s:16:\"banner_company_N\";s:2:\"-1\";s:16:\"banner_company_Y\";s:1:\"1\";s:16:\"banner_company_V\";s:1:\"1\";s:15:\"reply_company_N\";s:2:\"-1\";s:15:\"reply_company_Y\";s:1:\"1\";s:15:\"reply_company_V\";s:1:\"1\";s:15:\"phone_company_N\";s:2:\"-1\";s:15:\"phone_company_Y\";s:1:\"1\";s:15:\"phone_company_V\";s:1:\"1\";s:12:\"qq_company_N\";s:2:\"-1\";s:12:\"qq_company_Y\";s:1:\"1\";s:12:\"qq_company_V\";s:1:\"1\";s:14:\"case_company_N\";s:2:\"-1\";s:14:\"case_company_Y\";s:1:\"0\";s:14:\"case_company_V\";s:1:\"1\";s:14:\"site_company_N\";s:2:\"-1\";s:14:\"site_company_Y\";s:1:\"0\";s:14:\"site_company_V\";s:1:\"1\";s:16:\"youhui_company_N\";s:2:\"-1\";s:16:\"youhui_company_Y\";s:1:\"0\";s:16:\"youhui_company_V\";s:1:\"1\";s:14:\"news_company_N\";s:2:\"-1\";s:14:\"news_company_Y\";s:1:\"0\";s:14:\"news_company_V\";s:1:\"1\";s:13:\"ask_company_N\";s:1:\"0\";s:13:\"ask_company_Y\";s:1:\"0\";s:13:\"ask_company_V\";s:1:\"0\";s:16:\"answer_company_N\";s:1:\"0\";s:16:\"answer_company_Y\";s:1:\"0\";s:16:\"answer_company_V\";s:1:\"1\";s:15:\"diary_company_N\";s:2:\"-1\";s:15:\"diary_company_Y\";s:1:\"0\";s:15:\"diary_company_V\";s:1:\"1\";s:21:\"caseComment_company_N\";s:1:\"0\";s:21:\"caseComment_company_Y\";s:1:\"0\";s:21:\"caseComment_company_V\";s:1:\"1\";s:22:\"diaryComment_company_N\";s:1:\"0\";s:22:\"diaryComment_company_Y\";s:1:\"0\";s:22:\"diaryComment_company_V\";s:1:\"1\";s:24:\"productComment_company_N\";s:1:\"0\";s:24:\"productComment_company_Y\";s:1:\"0\";s:24:\"productComment_company_V\";s:1:\"1\";s:21:\"shopComment_company_N\";s:1:\"0\";s:21:\"shopComment_company_Y\";s:1:\"0\";s:21:\"shopComment_company_V\";s:1:\"1\";s:12:\"yuyue_shop_N\";s:2:\"-1\";s:12:\"yuyue_shop_Y\";s:2:\"-1\";s:12:\"yuyue_shop_V\";s:2:\"-1\";s:12:\"reply_shop_N\";s:2:\"-1\";s:12:\"reply_shop_Y\";s:1:\"1\";s:12:\"reply_shop_V\";s:1:\"1\";s:12:\"phone_shop_N\";s:2:\"-1\";s:12:\"phone_shop_Y\";s:1:\"1\";s:12:\"phone_shop_V\";s:1:\"1\";s:9:\"qq_shop_N\";s:2:\"-1\";s:9:\"qq_shop_Y\";s:1:\"1\";s:9:\"qq_shop_V\";s:1:\"1\";s:10:\"seo_shop_N\";s:2:\"-1\";s:10:\"seo_shop_Y\";s:1:\"1\";s:10:\"seo_shop_V\";s:1:\"1\";s:11:\"skin_shop_N\";s:2:\"-1\";s:11:\"skin_shop_Y\";s:1:\"1\";s:11:\"skin_shop_V\";s:1:\"1\";s:13:\"banner_shop_N\";s:2:\"-1\";s:13:\"banner_shop_Y\";s:1:\"1\";s:13:\"banner_shop_V\";s:1:\"1\";s:11:\"news_shop_N\";s:2:\"-1\";s:11:\"news_shop_Y\";s:1:\"0\";s:11:\"news_shop_V\";s:1:\"1\";s:13:\"youhui_shop_N\";s:2:\"-1\";s:13:\"youhui_shop_Y\";s:1:\"0\";s:13:\"youhui_shop_V\";s:1:\"1\";s:13:\"coupon_shop_N\";s:2:\"-1\";s:13:\"coupon_shop_Y\";s:1:\"0\";s:13:\"coupon_shop_V\";s:1:\"1\";s:14:\"product_shop_N\";s:2:\"-1\";s:14:\"product_shop_Y\";s:1:\"0\";s:14:\"product_shop_V\";s:1:\"1\";s:14:\"payment_shop_N\";s:2:\"-1\";s:14:\"payment_shop_Y\";s:1:\"0\";s:14:\"payment_shop_V\";s:1:\"1\";s:12:\"diary_shop_N\";s:1:\"0\";s:12:\"diary_shop_Y\";s:1:\"0\";s:12:\"diary_shop_V\";s:1:\"0\";}','审核权限','1404981160');
INSERT INTO jh_system_config VALUES ('mobile','a:5:{s:5:\"title\";s:27:\"江湖家居系统手机版\";s:3:\"url\";s:25:\"http://v6.jhcms.cn/mobile\";s:7:\"forward\";s:1:\"1\";s:12:\"down_android\";s:0:\"\";s:11:\"down_iphone\";s:0:\"\";}','3G版设置','1423538652');
INSERT INTO jh_system_config VALUES ('gold','a:4:{s:4:\"open\";s:1:\"1\";s:5:\"onpay\";s:1:\"1\";s:5:\"huilv\";s:1:\"1\";s:6:\"minpay\";s:1:\"1\";}','金币设置','1419061736');
INSERT INTO jh_system_config VALUES ('shop_rank','a:20:{s:6:\"rank_1\";s:1:\"1\";s:6:\"rank_2\";s:1:\"2\";s:6:\"rank_3\";s:1:\"3\";s:6:\"rank_4\";s:1:\"4\";s:6:\"rank_5\";s:1:\"5\";s:6:\"rank_6\";s:2:\"10\";s:6:\"rank_7\";s:2:\"20\";s:6:\"rank_8\";s:2:\"30\";s:6:\"rank_9\";s:2:\"40\";s:7:\"rank_10\";s:2:\"50\";s:7:\"rank_11\";s:3:\"100\";s:7:\"rank_12\";s:3:\"200\";s:7:\"rank_13\";s:3:\"300\";s:7:\"rank_14\";s:3:\"400\";s:7:\"rank_15\";s:3:\"500\";s:7:\"rank_16\";s:4:\"1000\";s:7:\"rank_17\";s:4:\"2000\";s:7:\"rank_18\";s:4:\"3000\";s:7:\"rank_19\";s:4:\"4000\";s:7:\"rank_20\";s:4:\"5000\";}','诚信规则','1388470066');
INSERT INTO jh_system_config VALUES ('zxb','a:5:{s:9:\"zxb_yezhu\";s:4:\"5000\";s:9:\"zxb_price\";s:7:\"5000000\";s:11:\"zxb_company\";s:4:\"3500\";s:6:\"hetong\";s:49:\"/static/hetong/平台施工交易规范合同.doc\";s:12:\"satisfaction\";s:4:\"99.2\";}','装修保配置','1418813705');
INSERT INTO jh_system_config VALUES ('access','a:12:{s:11:\"signup_type\";a:6:{s:6:\"member\";s:6:\"member\";s:7:\"company\";s:7:\"company\";s:2:\"gz\";s:2:\"gz\";s:8:\"designer\";s:8:\"designer\";s:8:\"mechanic\";s:8:\"mechanic\";s:4:\"shop\";s:4:\"shop\";}s:12:\"signup_count\";s:1:\"0\";s:11:\"signup_time\";s:1:\"0\";s:12:\"retain_uname\";s:0:\"\";s:6:\"denyip\";s:0:\"\";s:12:\"mobile_count\";s:2:\"10\";s:11:\"mobile_time\";s:2:\"10\";s:12:\"tender_count\";s:5:\"10000\";s:11:\"tender_time\";s:1:\"0\";s:10:\"verifycode\";a:6:{s:6:\"signup\";s:6:\"signup\";s:5:\"login\";s:5:\"login\";s:5:\"admin\";s:5:\"admin\";s:5:\"yuyue\";s:5:\"yuyue\";s:7:\"comment\";s:7:\"comment\";s:3:\"ask\";s:3:\"ask\";}s:6:\"closed\";s:1:\"0\";s:13:\"closed_reason\";s:0:\"\";}','访问设置','1423882672');
INSERT INTO jh_system_config VALUES ('comment','a:4:{s:12:\"article_type\";s:7:\"comment\";s:9:\"case_type\";s:7:\"comment\";s:10:\"diary_type\";s:7:\"comment\";s:10:\"snscomment\";s:597:\"<script type=\"text/javascript\">\r\n(function(){\r\nvar url = \"http://widget.weibo.com/distribution/comments.php?width=0&url=auto&border=1&brandline=y&dpc=1\";\r\nurl = url.replace(\"url=auto\", \"url=\" + encodeURIComponent(document.URL)); \r\ndocument.write(\'<iframe id=\"WBCommentFrame\" src=\"\' + url + \'\" scrolling=\"no\" frameborder=\"0\" style=\"width:100%\"></iframe>\');\r\n})();\r\n</script>\r\n<script src=\"http://tjs.sjs.sinajs.cn/open/widget/js/widget/comment.js\" type=\"text/javascript\" charset=\"utf-8\"></script>\r\n<script type=\"text/javascript\">\r\nwindow.WBComment.init({\r\n    \"id\": \"WBCommentFrame\"\r\n});\r\n</script>\";}','评论设置','1420012656');
INSERT INTO jh_system_config VALUES ('routeurl','a:21:{s:10:\"route_type\";s:1:\"0\";s:2:\"gs\";s:0:\"\";s:2:\"gz\";s:0:\"\";s:8:\"designer\";s:0:\"\";s:8:\"mechanic\";s:0:\"\";s:4:\"home\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"ask\";s:0:\"\";s:5:\"diray\";s:0:\"\";s:6:\"youhui\";s:0:\"\";s:8:\"activity\";s:0:\"\";s:7:\"article\";s:0:\"\";s:4:\"news\";s:0:\"\";s:10:\"mall/store\";s:0:\"\";s:7:\"product\";s:0:\"\";s:7:\"tenders\";s:0:\"\";s:3:\"zxb\";s:0:\"\";s:4:\"case\";s:0:\"\";s:4:\"blog\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"mall/shop\";s:0:\"\";}','URL设置','1423882662');
INSERT INTO jh_system_config VALUES ('domain','a:9:{s:4:\"case\";s:0:\"\";s:7:\"article\";s:0:\"\";s:4:\"home\";s:0:\"\";s:3:\"ask\";s:0:\"\";s:4:\"mall\";s:0:\"\";s:7:\"product\";s:0:\"\";s:7:\"company\";s:0:\"\";s:4:\"shop\";s:0:\"\";s:10:\"holddomain\";s:50:\"www|*admin*|shop|company|mall|*blog*|*space*|*bbs*\";}','域名设置','1423882656');
INSERT INTO jh_system_config VALUES ('wechat','a:4:{s:12:\"wechat_token\";s:3:\"123\";s:10:\"robot_open\";s:1:\"1\";s:10:\"tuling_key\";s:32:\"1fc91a84759da32183c0ffcdbd4ce45a\";s:10:\"rand_reply\";s:128:\"我今天累了，明天再陪你聊天吧\r\n哈哈~~\r\n你话好多啊，不跟你聊了\r\n虽然不懂，但觉得你说得很对\";}','微信配置','1420420894');
INSERT INTO jh_system_config VALUES ('jifen','a:4:{s:6:\"newreg\";s:3:\"300\";s:10:\"signtender\";s:3:\"800\";s:7:\"tuijian\";s:3:\"100\";s:3:\"pay\";s:3:\"0.1\";}','积分配置','1452578325');
INSERT INTO jh_system_config VALUES ('fenxiao','a:6:{s:5:\"audit\";s:3:\"201\";s:4:\"sign\";s:3:\"502\";s:7:\"tuijian\";s:3:\"203\";s:6:\"newreg\";s:4:\"1004\";s:10:\"signtender\";s:3:\"805\";s:3:\"pay\";s:2:\"15\";}','积分配置','1454392853');
INSERT INTO jh_system_config VALUES ('weixiu','a:2:{s:8:\"max_look\";s:1:\"3\";s:4:\"gold\";s:2:\"50\";}','维修配置','1453271697');
DROP TABLE IF EXISTS jh_system_logs;
CREATE TABLE `jh_system_logs` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(30) DEFAULT '',
  `action` varchar(50) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `content` mediumtext,
  `dateline` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_system_module;
CREATE TABLE `jh_system_module` (
  `mod_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `module` enum('top','menu','module') DEFAULT 'module',
  `level` tinyint(1) DEFAULT '3',
  `ctl` varchar(20) DEFAULT '',
  `act` varchar(20) DEFAULT '',
  `title` varchar(20) DEFAULT '',
  `visible` tinyint(1) DEFAULT '1',
  `parent_id` smallint(6) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1280 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1280;

INSERT INTO jh_system_module VALUES ('1','top','1','','','设置','1','0','10','1356434427');
INSERT INTO jh_system_module VALUES ('5','top','1','','','运营','1','0','60','1356434427');
INSERT INTO jh_system_module VALUES ('6','menu','2','','','权限管理','1','601','20','1356434427');
INSERT INTO jh_system_module VALUES ('7','menu','2','','','模块管理','1','601','30','1356434427');
INSERT INTO jh_system_module VALUES ('8','module','3','module/menu','index','导航菜单管理','1','7','1','1356434427');
INSERT INTO jh_system_module VALUES ('9','module','3','module/ctl','index','控制模型管理','1','7','11','1356434427');
INSERT INTO jh_system_module VALUES ('26','module','3','module/menu','create','添加导航菜单','0','7','2','1356434427');
INSERT INTO jh_system_module VALUES ('27','module','3','module/menu','save','保存导航菜单','0','7','6','1356434427');
INSERT INTO jh_system_module VALUES ('28','module','3','module/menu','edit','编辑导航菜单','0','7','3','1356434427');
INSERT INTO jh_system_module VALUES ('31','module','3','module/ctl','batch','指量添加控制模块','0','7','13','1356434427');
INSERT INTO jh_system_module VALUES ('32','module','3','module/ctl','save','保存控制模块','0','7','14','1356434427');
INSERT INTO jh_system_module VALUES ('33','module','3','module/ctl','detail','管理控制模型','0','7','12','1356434427');
INSERT INTO jh_system_module VALUES ('35','module','3','module/menu','update','更新导航菜单','0','7','4','1356434427');
INSERT INTO jh_system_module VALUES ('37','module','3','module/ctl','remove','删除控制模块','0','7','15','1356434427');
INSERT INTO jh_system_module VALUES ('44','module','3','module/menu','remove','删除导航菜单','0','7','5','1356437401');
INSERT INTO jh_system_module VALUES ('48','module','3','admin/role','index','角色管理','1','6','1','1356437591');
INSERT INTO jh_system_module VALUES ('49','module','3','admin/admin','index','管理员管理','1','6','2','1356437975');
INSERT INTO jh_system_module VALUES ('50','module','3','admin/role','create','创建角色','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('51','module','3','admin/role','detail','管理角色','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('52','module','3','admin/role','save','保存角色','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('53','module','3','admin/role','delete','删除角色','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('54','module','3','admin/admin','create','创建管理员','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('55','module','3','admin/admin','edit','修改管理员','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('56','module','3','admin/admin','save','保存管理员','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('57','module','3','admin/admin','delete','删除管理员','0','6','50','1356437975');
INSERT INTO jh_system_module VALUES ('59','menu','2','','','安防智能公司','1','743','10','1356438445');
INSERT INTO jh_system_module VALUES ('68','menu','2','','','广告管理','1','5','10','1356513698');
INSERT INTO jh_system_module VALUES ('69','menu','2','','','内容推荐','1','5','5','1356513708');
INSERT INTO jh_system_module VALUES ('70','menu','2','','','基础数据','1','1','6','1356513719');
INSERT INTO jh_system_module VALUES ('71','top','1','','','会员','1','0','20','1356513738');
INSERT INTO jh_system_module VALUES ('72','menu','2','','','会员管理','1','71','10','1356513776');
INSERT INTO jh_system_module VALUES ('85','menu','2','','','文章管理','1','5','20','1356600322');
INSERT INTO jh_system_module VALUES ('113','module','3','adv/adv','index','广告位管理','1','68','50','1357460157');
INSERT INTO jh_system_module VALUES ('114','module','3','adv/adv','detail','管理广告位','0','68','50','1357460260');
INSERT INTO jh_system_module VALUES ('115','module','3','adv/adv','edit','编辑广告位','0','68','50','1357460260');
INSERT INTO jh_system_module VALUES ('116','module','3','adv/adv','create','创建广告位','1','68','50','1357460260');
INSERT INTO jh_system_module VALUES ('117','module','3','adv/adv','delete','删除广告位','0','68','50','1357460260');
INSERT INTO jh_system_module VALUES ('119','module','3','adv/item','create','添加广告','0','68','50','1357460574');
INSERT INTO jh_system_module VALUES ('120','module','3','adv/item','edit','修改广告','0','68','50','1357460574');
INSERT INTO jh_system_module VALUES ('122','module','3','adv/item','delete','删除广告','0','68','50','1357460574');
INSERT INTO jh_system_module VALUES ('123','module','3','adv/adv','update','更新广告位','0','68','50','1357462189');
INSERT INTO jh_system_module VALUES ('124','module','3','adv/item','update','更新广告内容','0','68','50','1357463273');
INSERT INTO jh_system_module VALUES ('127','top','1','','','工具','1','0','70','1357609135');
INSERT INTO jh_system_module VALUES ('142','module','3','member/member','index','会员列表','1','72','10','1357714750');
INSERT INTO jh_system_module VALUES ('144','module','3','member/member','ulock','锁定会员','0','72','14','1357714750');
INSERT INTO jh_system_module VALUES ('146','module','3','member/member','recycle','会员回收站','1','72','15','1357714750');
INSERT INTO jh_system_module VALUES ('188','module','3','member/member','delete','删除会员','0','72','16','1358501680');
INSERT INTO jh_system_module VALUES ('189','module','3','member/member','regain','恢复会员','0','72','17','1358501680');
INSERT INTO jh_system_module VALUES ('223','module','3','data/censor','index','过滤词列表','1','70','50','1365701714');
INSERT INTO jh_system_module VALUES ('224','module','3','data/censor','create','添加过滤词','0','70','50','1365701714');
INSERT INTO jh_system_module VALUES ('228','module','3','data/censor','edit','修改过滤词','0','70','50','1366300235');
INSERT INTO jh_system_module VALUES ('229','module','3','data/censor','update','更新过滤词','0','70','50','1366300235');
INSERT INTO jh_system_module VALUES ('230','module','3','data/censor','delete','删除过滤词','0','70','50','1366300235');
INSERT INTO jh_system_module VALUES ('244','menu','2','','','站长工具','1','127','52','1366388132');
INSERT INTO jh_system_module VALUES ('245','module','3','tools/cache','clean','清空缓存','1','244','50','1366388194');
INSERT INTO jh_system_module VALUES ('269','menu','2','','','网站设置','1','1','1','1370085075');
INSERT INTO jh_system_module VALUES ('279','menu','2','','','数据库管理','1','127','50','1371537222');
INSERT INTO jh_system_module VALUES ('287','module','3','data/city','index','城市管理','1','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('288','module','3','data/city','create','添加城市','0','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('289','module','3','data/city','edit','修改城市','0','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('290','module','3','data/city','detail','查看城市','0','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('291','module','3','data/city','so','搜索城市','0','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('292','module','3','data/city','delete','删除城市','0','296','20','1371721154');
INSERT INTO jh_system_module VALUES ('296','menu','2','','','城市管理','1','1','2','1371724682');
INSERT INTO jh_system_module VALUES ('297','module','3','data/area','index','地区管理','1','296','30','1371724826');
INSERT INTO jh_system_module VALUES ('298','module','3','data/area','create','添加地区','0','296','30','1371724826');
INSERT INTO jh_system_module VALUES ('299','module','3','data/area','edit','修改地区','0','296','30','1371724826');
INSERT INTO jh_system_module VALUES ('300','module','3','data/area','delete','删除地区','0','296','30','1371724826');
INSERT INTO jh_system_module VALUES ('301','module','3','data/area','so','搜索地区','0','296','30','1371724826');
INSERT INTO jh_system_module VALUES ('302','module','3','data/area','detail','查看地区','0','296','30','1371724945');
INSERT INTO jh_system_module VALUES ('325','menu','2','','','属性管理','1','1','4','1372043122');
INSERT INTO jh_system_module VALUES ('326','module','3','data/attr','index','属性列表','1','325','10','1372043187');
INSERT INTO jh_system_module VALUES ('327','module','3','data/attr','create','添加属性','1','325','12','1372043187');
INSERT INTO jh_system_module VALUES ('328','module','3','data/attr','update','更新属性','0','325','13','1372043187');
INSERT INTO jh_system_module VALUES ('329','module','3','data/attr','delete','删除属性','0','325','14','1372043187');
INSERT INTO jh_system_module VALUES ('330','module','3','data/attr','detail','管理属性','0','325','15','1372053817');
INSERT INTO jh_system_module VALUES ('331','module','3','data/attr','updatevalue','更新选项','0','325','16','1372053880');
INSERT INTO jh_system_module VALUES ('332','module','3','data/attr','delvalue','删除选项','0','325','17','1372053880');
INSERT INTO jh_system_module VALUES ('333','module','3','article/cate','index','分类列表','1','85','20','1372065450');
INSERT INTO jh_system_module VALUES ('335','module','3','article/cate','edit','编辑分类','0','85','22','1372065450');
INSERT INTO jh_system_module VALUES ('336','module','3','article/cate','delete','删除分类','0','85','23','1372065450');
INSERT INTO jh_system_module VALUES ('337','module','3','article/cate','update','更新分类','0','85','24','1372065450');
INSERT INTO jh_system_module VALUES ('338','module','3','article/article','index','文章列表','1','85','10','1372087400');
INSERT INTO jh_system_module VALUES ('339','module','3','article/article','so','搜索文章','0','85','11','1372087400');
INSERT INTO jh_system_module VALUES ('340','module','3','article/article','create','添加文章','1','85','12','1372087400');
INSERT INTO jh_system_module VALUES ('341','module','3','article/article','edit','修改文章','0','85','13','1372087400');
INSERT INTO jh_system_module VALUES ('342','module','3','article/article','delete','删除文章','0','85','14','1372087400');
INSERT INTO jh_system_module VALUES ('344','module','3','article/cate','create','添加分类','0','85','21','1372153529');
INSERT INTO jh_system_module VALUES ('345','module','3','article/comment','index','评论列表','1','85','50','1372154080');
INSERT INTO jh_system_module VALUES ('346','module','3','article/comment','create','添加评论','0','85','50','1372154613');
INSERT INTO jh_system_module VALUES ('347','module','3','article/comment','edit','修改评论','0','85','50','1372154613');
INSERT INTO jh_system_module VALUES ('348','module','3','article/comment','delete','删除评论','0','85','50','1372154613');
INSERT INTO jh_system_module VALUES ('349','module','3','article/comment','so','搜索评论','0','85','50','1372154635');
INSERT INTO jh_system_module VALUES ('383','module','3','member/member','create','添加会员','0','72','11','1372437934');
INSERT INTO jh_system_module VALUES ('384','module','3','member/member','edit','修改会员','0','72','12','1372437934');
INSERT INTO jh_system_module VALUES ('385','module','3','member/member','so','搜索会员','0','72','13','1372438141');
INSERT INTO jh_system_module VALUES ('386','module','3','system/config','site','基本设置','1','269','1','1372869314');
INSERT INTO jh_system_module VALUES ('392','top','1','','','模块','1','0','40','1373427427');
INSERT INTO jh_system_module VALUES ('410','module','3','block/block','index','推荐位列表','1','69','50','1373537610');
INSERT INTO jh_system_module VALUES ('411','module','3','block/block','create','添加推荐位','0','69','50','1373537610');
INSERT INTO jh_system_module VALUES ('412','module','3','block/block','edit','修改推荐位','0','69','50','1373537610');
INSERT INTO jh_system_module VALUES ('413','module','3','block/block','delete','删除推荐位','0','69','50','1373537610');
INSERT INTO jh_system_module VALUES ('415','module','3','data/area','city','城市地区','0','296','30','1373597863');
INSERT INTO jh_system_module VALUES ('418','module','3','data/attr','so','搜索属性','0','325','11','1373645218');
INSERT INTO jh_system_module VALUES ('419','module','3','member/log','index','积分日志','1','72','50','1373683486');
INSERT INTO jh_system_module VALUES ('420','module','3','member/log','so','日志搜索','0','72','50','1373683486');
INSERT INTO jh_system_module VALUES ('430','module','3','member/member','gold','充值金币','0','72','18','1373792200');
INSERT INTO jh_system_module VALUES ('432','menu','2','','','我爱我家','1','392','50','1373902239');
INSERT INTO jh_system_module VALUES ('456','module','3','data/censor','so','搜索过滤词','0','70','50','1374220064');
INSERT INTO jh_system_module VALUES ('470','module','3','system/config','attach','附件设置','1','269','2','1374459620');
INSERT INTO jh_system_module VALUES ('471','module','3','system/config','bulletin','公告管理','1','269','3','1375237497');
INSERT INTO jh_system_module VALUES ('472','menu','2','','','帮助中心','1','5','30','1375412896');
INSERT INTO jh_system_module VALUES ('473','menu','2','','','关于我们','1','5','40','1375412919');
INSERT INTO jh_system_module VALUES ('474','module','3','article/about','index','内容列表','1','473','50','1375413188');
INSERT INTO jh_system_module VALUES ('475','module','3','article/about','so','搜索内容','1','473','50','1375413188');
INSERT INTO jh_system_module VALUES ('476','module','3','article/about','create','添加内容','0','473','50','1375413188');
INSERT INTO jh_system_module VALUES ('477','module','3','article/about','edit','修改内容','0','473','50','1375413188');
INSERT INTO jh_system_module VALUES ('478','module','3','article/about','delete','删除内容','0','473','50','1375413188');
INSERT INTO jh_system_module VALUES ('479','module','3','article/help','index','帮助管理','1','472','50','1375413284');
INSERT INTO jh_system_module VALUES ('480','module','3','article/help','so','搜索帮助','1','472','50','1375413284');
INSERT INTO jh_system_module VALUES ('481','module','3','article/help','create','添加帮助','0','472','50','1375413284');
INSERT INTO jh_system_module VALUES ('482','module','3','article/help','edit','修改帮助','0','472','50','1375413284');
INSERT INTO jh_system_module VALUES ('483','module','3','article/help','delete','删除帮助','0','472','50','1375413284');
INSERT INTO jh_system_module VALUES ('1125','module','3','weixin/weixin','admin','网站公众号','1','1002','10','1419942069');
INSERT INTO jh_system_module VALUES ('485','module','3','block/item','index','内容列表','1','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('486','module','3','block/item','push','推送内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('487','module','3','block/item','create','添加内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('488','module','3','block/item','edit','修改内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('489','module','3','block/item','delete','删除内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('490','module','3','block/item','update','更新内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('491','module','3','block/item','so','搜索内容','0','69','50','1375416112');
INSERT INTO jh_system_module VALUES ('492','module','3','block/block','detail','管理推荐位','0','69','50','1375455988');
INSERT INTO jh_system_module VALUES ('500','module','3','system/config','mail','邮件设置','1','951','40','1375789137');
INSERT INTO jh_system_module VALUES ('501','menu','2','','','友情连接','1','5','50','1376153711');
INSERT INTO jh_system_module VALUES ('502','module','3','market/links','index','友链管理','1','501','50','1376153822');
INSERT INTO jh_system_module VALUES ('503','module','3','market/links','create','添加友链','0','501','50','1376153822');
INSERT INTO jh_system_module VALUES ('504','module','3','market/links','edit','修改友链','0','501','50','1376153822');
INSERT INTO jh_system_module VALUES ('505','module','3','market/links','delete','删除友链','0','501','50','1376153822');
INSERT INTO jh_system_module VALUES ('506','module','3','system/config','sms','短信设置','1','951','50','1376155472');
INSERT INTO jh_system_module VALUES ('515','module','3','adv/adv','so','搜索广告位','0','68','50','1376479539');
INSERT INTO jh_system_module VALUES ('516','module','3','magic/upload','editor','编辑器上传图片','0','269','50','1376590326');
INSERT INTO jh_system_module VALUES ('517','module','3','system/config','ucenter','UCenter设置','1','930','10','1377316741');
INSERT INTO jh_system_module VALUES ('551','menu','2','','','支付配置','1','1','3','1380438926');
INSERT INTO jh_system_module VALUES ('553','module','3','payment/payment','index','支付接口','1','551','50','1380440527');
INSERT INTO jh_system_module VALUES ('554','module','3','tools/database','index','数据库管理','1','279','50','1380561710');
INSERT INTO jh_system_module VALUES ('560','module','3','system/config','locoyspider','火车头采集','1','244','50','1381539714');
INSERT INTO jh_system_module VALUES ('561','module','3','block/item','batch','批量推荐','0','69','50','1381723258');
INSERT INTO jh_system_module VALUES ('562','module','3','member/member','ucard','会员卡片层','0','72','19','1381942505');
INSERT INTO jh_system_module VALUES ('564','menu','2','','','案例管理','1','392','50','1383012925');
INSERT INTO jh_system_module VALUES ('565','module','3','article/link','index','连接标签','1','85','50','1383104861');
INSERT INTO jh_system_module VALUES ('566','module','3','article/link','create','添加标签','0','85','50','1383104861');
INSERT INTO jh_system_module VALUES ('567','module','3','article/link','edit','修改标签','0','85','50','1383104861');
INSERT INTO jh_system_module VALUES ('568','module','3','article/link','delete','删除标签','0','85','50','1383104861');
INSERT INTO jh_system_module VALUES ('569','module','3','article/link','update','更新标签','0','85','50','1383104861');
INSERT INTO jh_system_module VALUES ('570','module','3','member/member','face','更新头像','0','72','50','1383112630');
INSERT INTO jh_system_module VALUES ('571','menu','2','','','活动管理','1','392','10','1383291798');
INSERT INTO jh_system_module VALUES ('572','module','3','activity/cate','index','活动分类','1','571','1','1383291929');
INSERT INTO jh_system_module VALUES ('573','module','3','activity/cate','create','新增分类','0','571','2','1383291929');
INSERT INTO jh_system_module VALUES ('574','module','3','activity/cate','edit','修改分类','0','571','3','1383291929');
INSERT INTO jh_system_module VALUES ('575','module','3','activity/cate','delete','删除分类','0','571','4','1383291929');
INSERT INTO jh_system_module VALUES ('576','module','3','activity/cate','so','搜索分类','0','571','5','1383291929');
INSERT INTO jh_system_module VALUES ('577','module','3','data/attr','attrfrom','属性分类','1','325','5','1383357607');
INSERT INTO jh_system_module VALUES ('578','module','3','data/attr','createfrom','添加分类','0','325','6','1383357607');
INSERT INTO jh_system_module VALUES ('579','module','3','data/attr','editfrom','修改分类','0','325','7','1383357607');
INSERT INTO jh_system_module VALUES ('580','module','3','data/attr','deletefrom','删除分类','0','325','8','1383357607');
INSERT INTO jh_system_module VALUES ('581','module','3','activity/activity','index','活动管理','1','571','6','1383526842');
INSERT INTO jh_system_module VALUES ('582','module','3','activity/activity','create','新增活动','0','571','7','1383526842');
INSERT INTO jh_system_module VALUES ('583','module','3','activity/activity','edit','编辑活动','0','571','8','1383526842');
INSERT INTO jh_system_module VALUES ('584','module','3','activity/activity','delete','下架活动','0','571','9','1383526842');
INSERT INTO jh_system_module VALUES ('585','module','3','activity/activity','so','活动搜索','0','571','10','1383526842');
INSERT INTO jh_system_module VALUES ('586','module','3','article/article','dialog','选择文章','0','85','25','1383553687');
INSERT INTO jh_system_module VALUES ('587','module','3','activity/sign','index','报名管理','1','571','11','1383615344');
INSERT INTO jh_system_module VALUES ('588','module','3','activity/sign','create','新增报名','0','571','12','1383615344');
INSERT INTO jh_system_module VALUES ('589','module','3','activity/sign','edit','编辑报名','0','571','13','1383615344');
INSERT INTO jh_system_module VALUES ('590','module','3','activity/sign','so','搜索报名','0','571','14','1383615344');
INSERT INTO jh_system_module VALUES ('591','module','3','activity/sign','download','下载报名','0','571','15','1383615344');
INSERT INTO jh_system_module VALUES ('592','module','3','activity/sign','delete','删除报名','0','571','16','1383615344');
INSERT INTO jh_system_module VALUES ('593','module','3','activity/activity','renew','上架活动','0','571','10','1383619796');
INSERT INTO jh_system_module VALUES ('594','module','3','home/home','index','业主小区','1','432','1','1383790615');
INSERT INTO jh_system_module VALUES ('595','module','3','home/home','create','新增小区','0','432','2','1383790615');
INSERT INTO jh_system_module VALUES ('596','module','3','home/home','edit','编辑小区','0','432','3','1383790615');
INSERT INTO jh_system_module VALUES ('597','module','3','home/home','delete','删除小区','0','432','4','1383790615');
INSERT INTO jh_system_module VALUES ('598','module','3','home/home','so','搜索小区','0','432','5','1383791115');
INSERT INTO jh_system_module VALUES ('599','menu','2','','','设计师','1','71','50','1383820108');
INSERT INTO jh_system_module VALUES ('600','menu','2','','','商家管理','1','743','50','1383820117');
INSERT INTO jh_system_module VALUES ('601','top','1','','','系统','1','0','9','1383820332');
INSERT INTO jh_system_module VALUES ('602','module','3','member/member','dialog','选择用户','0','72','50','1383980953');
INSERT INTO jh_system_module VALUES ('603','module','3','home/photo','index','小区图片','0','432','50','1383991259');
INSERT INTO jh_system_module VALUES ('606','module','3','home/photo','delete','删除图片','0','432','50','1383991259');
INSERT INTO jh_system_module VALUES ('607','module','3','home/photo','upload','上传图片','0','432','50','1384142460');
INSERT INTO jh_system_module VALUES ('608','module','3','case/case','index','案例管理','1','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('609','module','3','case/case','create','添加案例','0','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('610','module','3','case/case','edit','修改案例','0','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('611','module','3','case/case','delete','删除案例','0','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('612','module','3','case/case','so','搜索案例','0','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('613','module','3','case/case','update','更新案例','0','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('614','module','3','case/case','audit','审核案例','1','564','50','1384156683');
INSERT INTO jh_system_module VALUES ('615','module','3','case/case','detail','案例图片','0','564','50','1384156757');
INSERT INTO jh_system_module VALUES ('616','module','3','case/photo','upload','上传图片','0','564','50','1384156757');
INSERT INTO jh_system_module VALUES ('617','module','3','case/photo','delete','删除图片','0','564','50','1384156757');
INSERT INTO jh_system_module VALUES ('618','module','3','case/photo','update','更新图片','0','564','50','1384156757');
INSERT INTO jh_system_module VALUES ('619','module','3','home/home','dialog','选择小区','0','432','6','1384166147');
INSERT INTO jh_system_module VALUES ('620','module','3','home/photo','update','更新操作','0','432','50','1384221175');
INSERT INTO jh_system_module VALUES ('621','module','3','home/photo','dialog','选择户型','0','432','50','1384241371');
INSERT INTO jh_system_module VALUES ('622','module','3','company/company','index','安防智能公司','1','59','10','1384249093');
INSERT INTO jh_system_module VALUES ('623','module','3','company/company','create','新增公司','0','59','10','1384249093');
INSERT INTO jh_system_module VALUES ('624','module','3','company/company','edit','编辑公司','0','59','10','1384249093');
INSERT INTO jh_system_module VALUES ('625','module','3','company/company','delete','删除公司','0','59','10','1384249093');
INSERT INTO jh_system_module VALUES ('626','module','3','company/company','so','搜索公司','0','59','10','1384249093');
INSERT INTO jh_system_module VALUES ('627','module','3','company/company','dialog','选择公司','0','59','10','1384329516');
INSERT INTO jh_system_module VALUES ('628','module','3','designer/designer','index','设计师管理','1','599','20','1384329790');
INSERT INTO jh_system_module VALUES ('629','module','3','designer/designer','create','添加设计师','0','599','21','1384329790');
INSERT INTO jh_system_module VALUES ('630','module','3','designer/designer','edit','编辑设计师','0','599','22','1384329790');
INSERT INTO jh_system_module VALUES ('631','module','3','designer/designer','delete','删除设计师','0','599','23','1384329790');
INSERT INTO jh_system_module VALUES ('632','module','3','designer/designer','so','搜索设计师','0','599','24','1384329790');
INSERT INTO jh_system_module VALUES ('633','module','3','company/company','audit','待审公司','1','59','10','1384334066');
INSERT INTO jh_system_module VALUES ('634','module','3','company/company','auditup','审核公司','0','59','10','1384334066');
INSERT INTO jh_system_module VALUES ('635','module','3','designer/designer','dialog','选择设计师','0','599','25','1384408120');
INSERT INTO jh_system_module VALUES ('636','module','3','system/config','score','评分配置','1','269','50','1384416441');
INSERT INTO jh_system_module VALUES ('637','module','3','company/comment','index','评价管理','1','59','50','1384419883');
INSERT INTO jh_system_module VALUES ('638','module','3','company/comment','create','新增评价','0','59','20','1384419883');
INSERT INTO jh_system_module VALUES ('639','module','3','company/comment','edit','编辑评价','0','59','20','1384419883');
INSERT INTO jh_system_module VALUES ('640','module','3','company/comment','delete','删除评价','0','59','20','1384419883');
INSERT INTO jh_system_module VALUES ('641','module','3','company/comment','so','搜索评价','0','59','20','1384419883');
INSERT INTO jh_system_module VALUES ('642','module','3','company/news','index','公司新闻','1','59','30','1384566317');
INSERT INTO jh_system_module VALUES ('643','module','3','company/news','create','新增新闻','0','59','30','1384566317');
INSERT INTO jh_system_module VALUES ('644','module','3','company/news','edit','编辑新闻','0','59','30','1384566317');
INSERT INTO jh_system_module VALUES ('645','module','3','company/news','delete','删除新闻','0','59','30','1384566317');
INSERT INTO jh_system_module VALUES ('646','module','3','company/news','so','搜索新闻','0','59','30','1384566317');
INSERT INTO jh_system_module VALUES ('647','menu','2','','','认证管理','1','71','50','1384573205');
INSERT INTO jh_system_module VALUES ('648','module','3','member/verify','index','认证管理','1','647','50','1384573242');
INSERT INTO jh_system_module VALUES ('649','module','3','member/verify','audit','审核认证','1','647','50','1384573463');
INSERT INTO jh_system_module VALUES ('650','module','3','member/verify','edit','修改认证','0','647','50','1384573463');
INSERT INTO jh_system_module VALUES ('651','module','3','member/verify','update','更新认证','0','647','50','1384573463');
INSERT INTO jh_system_module VALUES ('652','module','3','member/verify','delete','删除认证','0','647','50','1384573463');
INSERT INTO jh_system_module VALUES ('653','module','3','shop/shop','index','商家管理','1','600','10','1384583708');
INSERT INTO jh_system_module VALUES ('654','module','3','shop/shop','create','添加商家','0','600','11','1384583708');
INSERT INTO jh_system_module VALUES ('655','module','3','shop/shop','edit','修改商家','0','600','12','1384583708');
INSERT INTO jh_system_module VALUES ('656','module','3','shop/shop','delete','删除商家','0','600','13','1384583708');
INSERT INTO jh_system_module VALUES ('657','module','3','shop/shop','so','搜索商家','0','600','14','1384583708');
INSERT INTO jh_system_module VALUES ('658','module','3','company/youhui','index','优惠信息','1','59','40','1384589539');
INSERT INTO jh_system_module VALUES ('659','module','3','company/youhui','create','新增优惠','0','59','40','1384589539');
INSERT INTO jh_system_module VALUES ('660','module','3','company/youhui','edit','编辑优惠','0','59','40','1384589539');
INSERT INTO jh_system_module VALUES ('661','module','3','company/youhui','delete','删除优惠','0','59','40','1384589539');
INSERT INTO jh_system_module VALUES ('662','module','3','company/youhui','so','搜索优惠','0','59','40','1384589539');
INSERT INTO jh_system_module VALUES ('663','module','3','company/sign','index','报名管理','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('664','module','3','company/sign','create','添加报名','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('665','module','3','company/sign','edit','编辑报名','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('666','module','3','company/sign','delete','删除报名','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('667','module','3','company/sign','so','报名搜索','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('668','module','3','company/sign','download','下载报名','0','59','40','1384737310');
INSERT INTO jh_system_module VALUES ('669','menu','2','','','装修招标','1','392','1','1384746196');
INSERT INTO jh_system_module VALUES ('670','menu','2','','','模板设置','1','1','50','1384760168');
INSERT INTO jh_system_module VALUES ('671','module','3','system/theme','index','模板管理','1','670','50','1384760203');
INSERT INTO jh_system_module VALUES ('672','module','3','tenders/tenders','index','招标管理','1','669','50','1384826638');
INSERT INTO jh_system_module VALUES ('673','module','3','tenders/tenders','create','新增招标','0','669','50','1384826638');
INSERT INTO jh_system_module VALUES ('674','module','3','tenders/tenders','edit','编辑招标','0','669','50','1384826638');
INSERT INTO jh_system_module VALUES ('675','module','3','tenders/tenders','delete','删除招标','0','669','50','1384826638');
INSERT INTO jh_system_module VALUES ('676','module','3','tenders/tenders','so','搜索招标','0','669','50','1384826638');
INSERT INTO jh_system_module VALUES ('677','module','3','tenders/look','index','竞标管理','0','669','50','1384845748');
INSERT INTO jh_system_module VALUES ('678','module','3','tenders/look','create','分标操作','0','669','50','1384845748');
INSERT INTO jh_system_module VALUES ('679','module','3','tenders/look','update','更新分标','0','669','50','1384910383');
INSERT INTO jh_system_module VALUES ('680','module','3','tenders/track','index','招标跟踪','0','669','50','1384930525');
INSERT INTO jh_system_module VALUES ('681','module','3','tenders/track','create','新增跟踪','0','669','50','1384930525');
INSERT INTO jh_system_module VALUES ('682','module','3','tenders/track','edit','编辑跟踪','0','669','50','1384930525');
INSERT INTO jh_system_module VALUES ('683','module','3','activity/lanmu','activity','活动栏目','0','571','50','1384938340');
INSERT INTO jh_system_module VALUES ('684','module','3','activity/lanmu','create','活动栏目','0','571','50','1384938340');
INSERT INTO jh_system_module VALUES ('685','module','3','activity/lanmu','edit','活动栏目','0','571','50','1384938340');
INSERT INTO jh_system_module VALUES ('686','module','3','activity/lanmu','delete','活动栏目','0','571','50','1384938340');
INSERT INTO jh_system_module VALUES ('687','module','3','tenders/setting','index','招标配置','1','669','1','1385006173');
INSERT INTO jh_system_module VALUES ('688','module','3','tenders/setting','create','新增配置','0','669','2','1385006173');
INSERT INTO jh_system_module VALUES ('689','module','3','tenders/setting','edit','修改配置','0','669','3','1385006173');
INSERT INTO jh_system_module VALUES ('690','module','3','tenders/setting','delete','删除配置','0','669','4','1385006173');
INSERT INTO jh_system_module VALUES ('691','module','3','tenders/setting','so','搜索配置','0','669','5','1385006173');
INSERT INTO jh_system_module VALUES ('692','module','3','member/verify','so','搜索认证','0','647','50','1385018429');
INSERT INTO jh_system_module VALUES ('693','module','3','home/site','index','在建工地','1','432','50','1385084211');
INSERT INTO jh_system_module VALUES ('694','module','3','home/site','create','新增工地','0','432','50','1385084211');
INSERT INTO jh_system_module VALUES ('695','module','3','home/site','edit','修改工地','0','432','50','1385084211');
INSERT INTO jh_system_module VALUES ('696','module','3','home/site','delete','删除工地','0','432','50','1385084211');
INSERT INTO jh_system_module VALUES ('697','module','3','home/site','so','搜索工地','0','432','50','1385084211');
INSERT INTO jh_system_module VALUES ('698','module','3','home/item','index','工地日记','0','432','50','1385107056');
INSERT INTO jh_system_module VALUES ('699','module','3','home/item','create','新增日记','0','432','50','1385107056');
INSERT INTO jh_system_module VALUES ('700','module','3','home/item','edit','修改日记','0','432','50','1385107056');
INSERT INTO jh_system_module VALUES ('701','module','3','home/item','delete','删除日记','0','432','50','1385107056');
INSERT INTO jh_system_module VALUES ('702','module','3','home/item','so','搜索日记','0','432','50','1385107056');
INSERT INTO jh_system_module VALUES ('703','module','3','company/banner','company','BANNER管理','0','59','50','1385602990');
INSERT INTO jh_system_module VALUES ('704','module','3','company/banner','create','新增BANNER','0','59','50','1385602990');
INSERT INTO jh_system_module VALUES ('705','module','3','company/banner','edit','编辑BANNER','0','59','50','1385602990');
INSERT INTO jh_system_module VALUES ('706','module','3','company/banner','delete','删除BANNER','0','59','50','1385602990');
INSERT INTO jh_system_module VALUES ('707','module','3','company/banner','so','搜索BANNER','0','59','50','1385602990');
INSERT INTO jh_system_module VALUES ('708','module','3','member/verify','dopass','认证通过','0','647','50','1385609706');
INSERT INTO jh_system_module VALUES ('709','module','3','member/verify','dorefuse','认证拒绝','0','647','50','1385609706');
INSERT INTO jh_system_module VALUES ('710','module','3','company/photo','company','荣誉资质','0','59','50','1385628275');
INSERT INTO jh_system_module VALUES ('711','module','3','company/photo','create','新增荣誉资质','0','59','50','1385628275');
INSERT INTO jh_system_module VALUES ('712','module','3','company/photo','edit','修改荣誉资质','0','59','50','1385628275');
INSERT INTO jh_system_module VALUES ('713','module','3','company/photo','delete','删除荣誉资质','0','59','50','1385628275');
INSERT INTO jh_system_module VALUES ('714','module','3','company/photo','so','搜索荣誉资质','0','59','50','1385628275');
INSERT INTO jh_system_module VALUES ('715','module','3','company/youhui','audit','批量审核优惠信息','0','59','50','1385629629');
INSERT INTO jh_system_module VALUES ('716','module','3','company/comment','audit','批量审核点评','0','59','50','1385629814');
INSERT INTO jh_system_module VALUES ('717','module','3','shop/shop','doaudit','审核商家','0','600','15','1385631233');
INSERT INTO jh_system_module VALUES ('719','module','3','shop/brand','index','品牌管理','1','600','50','1385634400');
INSERT INTO jh_system_module VALUES ('720','module','3','shop/brand','create','添加品牌','0','600','51','1385634400');
INSERT INTO jh_system_module VALUES ('721','module','3','shop/brand','edit','修改品牌','0','600','52','1385634400');
INSERT INTO jh_system_module VALUES ('722','module','3','shop/brand','doaudit','审核品牌','0','600','53','1385634400');
INSERT INTO jh_system_module VALUES ('723','module','3','shop/brand','delete','删除品牌','0','600','54','1385634400');
INSERT INTO jh_system_module VALUES ('724','module','3','shop/cate','index','分类管理','1','600','20','1385634862');
INSERT INTO jh_system_module VALUES ('725','module','3','shop/cate','create','添加分类','0','600','21','1385634862');
INSERT INTO jh_system_module VALUES ('726','module','3','shop/cate','edit','修改分类','0','600','22','1385634862');
INSERT INTO jh_system_module VALUES ('727','module','3','shop/cate','so','搜索分类','0','600','23','1385634862');
INSERT INTO jh_system_module VALUES ('728','module','3','shop/cate','doaudit','审核分类','0','600','24','1385634862');
INSERT INTO jh_system_module VALUES ('729','module','3','shop/cate','delete','删除分类','0','600','25','1385634862');
INSERT INTO jh_system_module VALUES ('730','module','3','shop/brand','so','搜索品牌','0','600','55','1385634862');
INSERT INTO jh_system_module VALUES ('731','module','3','system/config','integral','消费设置','1','269','7','1385779123');
INSERT INTO jh_system_module VALUES ('733','module','3','system/config','audit','审核权限','1','950','8','1385791074');
INSERT INTO jh_system_module VALUES ('734','module','3','company/company','vip','设置VIP公司','0','59','50','1385800429');
INSERT INTO jh_system_module VALUES ('735','module','3','shop/shop','vip','设置VIP','0','600','50','1385801113');
INSERT INTO jh_system_module VALUES ('736','module','3','shop/cate','children','商家子分类','0','600','25','1385977686');
INSERT INTO jh_system_module VALUES ('737','module','3','shop/vcate','index','虚拟分类','1','600','50','1386065840');
INSERT INTO jh_system_module VALUES ('738','module','3','shop/vcate','create','添加虚拟分类','0','600','50','1386065840');
INSERT INTO jh_system_module VALUES ('739','module','3','shop/vcate','edit','修改虚拟分类','0','600','50','1386065840');
INSERT INTO jh_system_module VALUES ('740','module','3','shop/vcate','delete','删除虚拟分类','0','600','50','1386065840');
INSERT INTO jh_system_module VALUES ('741','module','3','shop/vcate','so','搜索虚拟分类','0','600','50','1386065840');
INSERT INTO jh_system_module VALUES ('742','module','3','shop/shop','dialog','选择商铺','0','600','16','1386066147');
INSERT INTO jh_system_module VALUES ('743','top','1','','','商家','1','0','25','1386120170');
INSERT INTO jh_system_module VALUES ('744','menu','2','','','商品管理','1','743','50','1386120210');
INSERT INTO jh_system_module VALUES ('745','module','3','product/product','index','商品管理','1','744','10','1386120480');
INSERT INTO jh_system_module VALUES ('746','module','3','product/product','create','添加商品','0','744','11','1386120480');
INSERT INTO jh_system_module VALUES ('747','module','3','product/product','edit','修改商品','0','744','12','1386120480');
INSERT INTO jh_system_module VALUES ('748','module','3','product/product','doaudit','审核商品','0','744','13','1386120480');
INSERT INTO jh_system_module VALUES ('749','module','3','product/product','delete','删除商品','0','744','14','1386120480');
INSERT INTO jh_system_module VALUES ('750','module','3','product/product','so','搜索商品','0','744','15','1386120480');
INSERT INTO jh_system_module VALUES ('751','menu','2','','','装修日记','1','392','50','1386141057');
INSERT INTO jh_system_module VALUES ('752','module','3','diary/diary','index','日记管理','1','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('753','module','3','diary/diary','create','写日记','0','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('754','module','3','diary/diary','edit','修改日记','0','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('755','module','3','diary/diary','delete','删除日记','0','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('756','module','3','diary/diary','so','搜索日记','0','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('757','module','3','diary/diary','doaudit','审核日记','0','751','50','1386141326');
INSERT INTO jh_system_module VALUES ('758','module','3','diary/item','index','日记文章','0','751','50','1386150589');
INSERT INTO jh_system_module VALUES ('759','module','3','diary/item','create','新增日记文章','0','751','50','1386150589');
INSERT INTO jh_system_module VALUES ('760','module','3','diary/item','edit','修改日记文章','0','751','50','1386150589');
INSERT INTO jh_system_module VALUES ('761','module','3','diary/item','delete','删除日记文章','0','751','50','1386150589');
INSERT INTO jh_system_module VALUES ('762','module','3','diary/item','so','搜索日记文章','0','751','50','1386150589');
INSERT INTO jh_system_module VALUES ('763','module','3','product/photo','index','相册管理','1','744','50','1386152379');
INSERT INTO jh_system_module VALUES ('764','module','3','product/photo','upload','上传图片','0','744','50','1386152379');
INSERT INTO jh_system_module VALUES ('765','module','3','product/photo','update','更新图片','0','744','50','1386152379');
INSERT INTO jh_system_module VALUES ('766','module','3','product/photo','delete','删除图片','0','744','50','1386152379');
INSERT INTO jh_system_module VALUES ('767','module','3','product/photo','product','商品图片','0','744','50','1386152379');
INSERT INTO jh_system_module VALUES ('768','menu','2','','','优惠券管理','1','743','50','1386215618');
INSERT INTO jh_system_module VALUES ('769','module','3','shop/coupon','index','优惠券管理','1','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('770','module','3','shop/coupon','create','添加优惠券','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('771','module','3','shop/coupon','edit','修改优惠券','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('772','module','3','shop/coupon','delete','删除优惠券','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('773','module','3','shop/coupon','so','搜索优惠券','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('774','module','3','shop/coupon','doaudit','审核优惠券','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('775','module','3','shop/coupon','downloads','下载日志','1','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('776','module','3','shop/coupon','downloadEdit','修改日志','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('777','module','3','shop/coupon','downloadDelete','删除日志','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('778','module','3','shop/coupon','downloadSo','搜索日志','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('779','module','3','shop/coupon','downloadCoupon','优惠券日志','0','768','50','1386215832');
INSERT INTO jh_system_module VALUES ('780','module','3','block/page','index','推荐页面','1','69','10','1386236761');
INSERT INTO jh_system_module VALUES ('781','module','3','block/page','create','添加页面','0','69','11','1386236761');
INSERT INTO jh_system_module VALUES ('782','module','3','block/page','edit','修改页面','0','69','12','1386236761');
INSERT INTO jh_system_module VALUES ('783','module','3','block/page','delete','删除页面','0','69','13','1386236761');
INSERT INTO jh_system_module VALUES ('784','module','3','shop/attr','index','属性管理','1','600','41','1386561013');
INSERT INTO jh_system_module VALUES ('785','module','3','shop/attr','so','搜索属性','0','600','42','1386561013');
INSERT INTO jh_system_module VALUES ('786','module','3','shop/attr','create','添加属性','0','600','43','1386561013');
INSERT INTO jh_system_module VALUES ('787','module','3','shop/attr','update','更新属性','0','600','44','1386561013');
INSERT INTO jh_system_module VALUES ('788','module','3','shop/attr','delete','删除属性','0','600','45','1386561013');
INSERT INTO jh_system_module VALUES ('789','module','3','shop/attr','detail','管理属性','0','600','46','1386561013');
INSERT INTO jh_system_module VALUES ('790','module','3','shop/attr','updatevalue','更新选项','0','600','47','1386561013');
INSERT INTO jh_system_module VALUES ('791','module','3','shop/attr','delvalue','删除选项','0','600','48','1386561013');
INSERT INTO jh_system_module VALUES ('792','module','3','product/product','shop','商铺商品','0','744','16','1386570663');
INSERT INTO jh_system_module VALUES ('793','module','3','product/photo','so','搜索图片','0','744','50','1386578582');
INSERT INTO jh_system_module VALUES ('794','module','3','shop/news','index','活动资讯','1','600','61','1386580627');
INSERT INTO jh_system_module VALUES ('795','module','3','shop/news','create','添加活动资讯','0','600','62','1386580627');
INSERT INTO jh_system_module VALUES ('796','module','3','shop/news','edit','修改活动资讯','0','600','63','1386580627');
INSERT INTO jh_system_module VALUES ('797','module','3','shop/news','delete','删除活动资讯','0','600','64','1386580627');
INSERT INTO jh_system_module VALUES ('798','module','3','shop/news','so','搜索活动资讯','0','600','65','1386580627');
INSERT INTO jh_system_module VALUES ('799','module','3','shop/news','doaudit','审核活动资讯','0','600','66','1386580627');
INSERT INTO jh_system_module VALUES ('800','menu','2','','','订单管理','1','743','50','1386581725');
INSERT INTO jh_system_module VALUES ('801','module','3','trade/order','index','订单管理','1','800','10','1386654631');
INSERT INTO jh_system_module VALUES ('802','module','3','trade/order','detail','查看订单','0','800','11','1386654631');
INSERT INTO jh_system_module VALUES ('803','module','3','trade/order','edit','修改订单','0','800','12','1386654631');
INSERT INTO jh_system_module VALUES ('804','module','3','trade/order','doaudit','审核订单','0','800','13','1386654631');
INSERT INTO jh_system_module VALUES ('805','module','3','trade/order','delete','删除订单','0','800','14','1386654631');
INSERT INTO jh_system_module VALUES ('806','module','3','trade/order','so','搜索订单','0','800','15','1386654631');
INSERT INTO jh_system_module VALUES ('807','module','3','trade/product','create','添加商品','0','800','20','1386660909');
INSERT INTO jh_system_module VALUES ('808','module','3','trade/product','delete','删除商品','0','800','21','1386660909');
INSERT INTO jh_system_module VALUES ('809','module','3','trade/product','edit','修改商品','0','800','22','1386660909');
INSERT INTO jh_system_module VALUES ('810','module','3','trade/product','update','更新商品','0','800','23','1386660909');
INSERT INTO jh_system_module VALUES ('811','module','3','shop/yuyue','index','预约管理','1','800','50','1386660909');
INSERT INTO jh_system_module VALUES ('812','module','3','shop/yuyue','create','添加预约','0','800','50','1386660909');
INSERT INTO jh_system_module VALUES ('813','module','3','shop/yuyue','edit','修改预约','0','800','50','1386660909');
INSERT INTO jh_system_module VALUES ('814','module','3','shop/yuyue','delete','删除预约','0','800','50','1386660909');
INSERT INTO jh_system_module VALUES ('815','module','3','shop/yuyue','so','搜索预约','0','800','50','1386660909');
INSERT INTO jh_system_module VALUES ('816','module','3','home/survey','index','小区调查','0','432','50','1386667892');
INSERT INTO jh_system_module VALUES ('817','module','3','home/survey','create','新增调查','0','432','50','1386667892');
INSERT INTO jh_system_module VALUES ('818','module','3','home/survey','edit','编辑调查','0','432','50','1386667892');
INSERT INTO jh_system_module VALUES ('819','module','3','home/survey','delete','删除调查','0','432','50','1386667892');
INSERT INTO jh_system_module VALUES ('820','module','3','home/survey','so','搜索调查','0','432','50','1386668484');
INSERT INTO jh_system_module VALUES ('821','module','3','product/comment','index','评论管理','1','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('822','module','3','product/comment','reply','回复评论','0','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('823','module','3','product/comment','edit','修改评论','0','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('824','module','3','product/comment','delete','删除评论','0','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('825','module','3','product/comment','doaudit','审核评论','0','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('826','module','3','product/comment','so','搜索评论','0','744','50','1386670456');
INSERT INTO jh_system_module VALUES ('827','module','3','shop/comment','index','留言管理','1','600','100','1386670559');
INSERT INTO jh_system_module VALUES ('828','module','3','shop/comment','reply','回复留言','0','600','101','1386670559');
INSERT INTO jh_system_module VALUES ('829','module','3','shop/comment','edit','修改留言','0','600','102','1386670559');
INSERT INTO jh_system_module VALUES ('830','module','3','shop/comment','doaudit','审核留言','0','600','103','1386670559');
INSERT INTO jh_system_module VALUES ('831','module','3','shop/comment','delete','删除留言','0','600','104','1386670559');
INSERT INTO jh_system_module VALUES ('832','module','3','shop/comment','so','搜索留言','0','600','50','1386670559');
INSERT INTO jh_system_module VALUES ('833','module','3','system/config','mobile','3G版设置','1','269','9','1386842790');
INSERT INTO jh_system_module VALUES ('834','module','3','company/yuyue','index','预约管理','1','59','50','1387011369');
INSERT INTO jh_system_module VALUES ('835','module','3','company/yuyue','create','新增预约','0','59','50','1387011369');
INSERT INTO jh_system_module VALUES ('836','module','3','company/yuyue','edit','修改预约','0','59','50','1387011369');
INSERT INTO jh_system_module VALUES ('837','module','3','company/yuyue','delete','删除预约','0','59','50','1387011369');
INSERT INTO jh_system_module VALUES ('838','module','3','company/yuyue','so','搜索预约','0','59','50','1387011369');
INSERT INTO jh_system_module VALUES ('839','module','3','designer/yuyue','index','预约管理','1','599','50','1387013415');
INSERT INTO jh_system_module VALUES ('840','module','3','designer/yuyue','create','新增预约','0','599','50','1387013415');
INSERT INTO jh_system_module VALUES ('841','module','3','designer/yuyue','edit','编辑预约','0','599','50','1387013415');
INSERT INTO jh_system_module VALUES ('842','module','3','designer/yuyue','delete','删除预约','0','599','50','1387013415');
INSERT INTO jh_system_module VALUES ('843','module','3','designer/yuyue','so','搜索预约','0','599','50','1387013415');
INSERT INTO jh_system_module VALUES ('844','module','3','case/comment','index','案例评论','1','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('845','module','3','case/comment','create','新增评论','0','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('846','module','3','case/comment','edit','修改评论','0','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('847','module','3','case/comment','delete','删除评论','0','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('848','module','3','case/comment','so','搜索评论','0','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('849','module','3','case/comment','doaudit','审核评论','0','564','50','1387184758');
INSERT INTO jh_system_module VALUES ('850','module','3','shop/banner','shop','商铺轮转','0','600','50','1387186049');
INSERT INTO jh_system_module VALUES ('851','module','3','shop/banner','upload','上传轮转','0','600','50','1387186049');
INSERT INTO jh_system_module VALUES ('852','module','3','shop/banner','update','更新轮转','0','600','50','1387186049');
INSERT INTO jh_system_module VALUES ('853','module','3','shop/banner','delete','删除轮转','0','600','50','1387186049');
INSERT INTO jh_system_module VALUES ('854','module','3','diary/comment','index','日记评论','1','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('855','module','3','diary/comment','create','新增评论','0','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('856','module','3','diary/comment','edit','修改评论','0','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('857','module','3','diary/comment','delete','删除评论','0','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('858','module','3','diary/comment','so','搜索评论','0','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('859','module','3','diary/comment','doaudit','审核评论','0','751','50','1387438194');
INSERT INTO jh_system_module VALUES ('860','menu','2','','','问答管理','1','392','50','1387440138');
INSERT INTO jh_system_module VALUES ('861','module','3','ask/cate','index','问答分类','1','860','50','1387443701');
INSERT INTO jh_system_module VALUES ('862','module','3','ask/cate','create','新增分类','0','860','50','1387443701');
INSERT INTO jh_system_module VALUES ('863','module','3','ask/cate','edit','修改分类','0','860','50','1387443701');
INSERT INTO jh_system_module VALUES ('864','module','3','ask/cate','delete','删除分类','0','860','50','1387443701');
INSERT INTO jh_system_module VALUES ('865','module','3','ask/cate','so','搜索分类','0','860','50','1387443701');
INSERT INTO jh_system_module VALUES ('866','module','3','ask/cate','children','查询下级分类','0','860','50','1387444648');
INSERT INTO jh_system_module VALUES ('867','module','3','ask/ask','index','问题管理','1','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('868','module','3','ask/ask','create','新增问题','0','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('869','module','3','ask/ask','edit','修改问题','0','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('870','module','3','ask/ask','delete','删除问题','0','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('871','module','3','ask/ask','so','搜索问题','0','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('872','module','3','ask/ask','doaudit','审核问题','0','860','50','1387445353');
INSERT INTO jh_system_module VALUES ('873','module','3','ask/answer','index','答案管理','1','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('874','module','3','ask/answer','create','新增答案','0','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('875','module','3','ask/answer','edit','修改答案','0','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('876','module','3','ask/answer','delete','删除答案','0','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('877','module','3','ask/answer','doaudit','审核答案','0','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('878','module','3','ask/answer','so','搜索答案','0','860','50','1387502613');
INSERT INTO jh_system_module VALUES ('879','module','3','ask/answer','good','问题补充','0','860','50','1387504178');
INSERT INTO jh_system_module VALUES ('1071','module','3','zxb/zxb','create','装修保添加','0','1069','50','1417418734');
INSERT INTO jh_system_module VALUES ('1070','module','3','zxb/zxb','index','装修保管理','1','1069','50','1417418734');
INSERT INTO jh_system_module VALUES ('1069','menu','2','','','装修保','1','392','5','1417418525');
INSERT INTO jh_system_module VALUES ('885','module','3','system/smstmpl','index','短信模板','0','951','50','1387875598');
INSERT INTO jh_system_module VALUES ('886','module','3','system/smstmpl','create','新增模板','0','951','50','1387875598');
INSERT INTO jh_system_module VALUES ('887','module','3','system/smstmpl','edit','修改模板','0','951','50','1387875598');
INSERT INTO jh_system_module VALUES ('888','module','3','system/emailtmpl','index','邮件模板','0','951','41','1388025272');
INSERT INTO jh_system_module VALUES ('889','module','3','system/emailtmpl','create','新增模板','0','951','41','1388025272');
INSERT INTO jh_system_module VALUES ('890','module','3','system/emailtmpl','edit','修改模板','0','951','41','1388025272');
INSERT INTO jh_system_module VALUES ('891','module','3','payment/payment','config','配置接口','0','551','50','1388027577');
INSERT INTO jh_system_module VALUES ('892','module','3','payment/payment','install','安装接口','0','551','50','1388027577');
INSERT INTO jh_system_module VALUES ('893','module','3','payment/payment','uninstall','卸载接口','0','551','50','1388027577');
INSERT INTO jh_system_module VALUES ('894','module','3','system/seotmpl','index','全站SEO','1','269','60','1388044619');
INSERT INTO jh_system_module VALUES ('895','module','3','system/seotmpl','create','新增模板','0','269','60','1388044619');
INSERT INTO jh_system_module VALUES ('896','module','3','system/seotmpl','edit','修改模板','0','269','60','1388044619');
INSERT INTO jh_system_module VALUES ('897','module','3','payment/log','index','支付流水','1','551','50','1388048090');
INSERT INTO jh_system_module VALUES ('899','module','3','payment/log','so','修改流水','0','551','50','1388048090');
INSERT INTO jh_system_module VALUES ('901','module','3','payment/log','status','更改状态','0','551','50','1388048090');
INSERT INTO jh_system_module VALUES ('902','module','3','system/config','gold','金币设置','1','269','6','1388070822');
INSERT INTO jh_system_module VALUES ('903','module','3','home/tuan','index','团装小区','1','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('904','module','3','home/tuan','create','新增团装','0','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('905','module','3','home/tuan','edit','修改团装','0','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('906','module','3','home/tuan','delete','删除团装','0','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('907','module','3','home/tuan','so','搜索团装','0','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('908','module','3','home/tuan','doaudit','审核团装','0','432','50','1388134120');
INSERT INTO jh_system_module VALUES ('909','module','3','home/package','index','团装套餐','0','432','50','1388137587');
INSERT INTO jh_system_module VALUES ('910','module','3','home/package','create','新增套餐','0','432','50','1388137587');
INSERT INTO jh_system_module VALUES ('911','module','3','home/package','edit','修改套餐','0','432','50','1388137587');
INSERT INTO jh_system_module VALUES ('912','module','3','home/sign','index','团装报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('913','module','3','home/sign','create','新增报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('914','module','3','home/sign','edit','编辑报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('915','module','3','home/sign','delete','删除报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('916','module','3','home/sign','so','搜索报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('917','module','3','home/sign','download','下载报名','0','432','50','1388195003');
INSERT INTO jh_system_module VALUES ('918','module','3','system/config','shop_rank','诚信规则','1','600','10','1388411905');
INSERT INTO jh_system_module VALUES ('919','module','3','member/member','manager','管理会员','0','72','50','1388485506');
INSERT INTO jh_system_module VALUES ('920','module','3','tenders/look','tongji','分单统计','1','669','50','1389060265');
INSERT INTO jh_system_module VALUES ('921','module','3','article/link','so','搜索标签','0','85','50','1389168755');
INSERT INTO jh_system_module VALUES ('922','module','3','system/theme','detail','管理模板','0','670','50','1389258144');
INSERT INTO jh_system_module VALUES ('923','module','3','system/theme','install','安装模板','0','670','50','1389258144');
INSERT INTO jh_system_module VALUES ('924','module','3','system/theme','uninstall','卸载模板','0','670','50','1389258144');
INSERT INTO jh_system_module VALUES ('925','module','3','system/theme','setdefault','设置默认模板','0','670','50','1389258144');
INSERT INTO jh_system_module VALUES ('927','module','3','system/seotmpl','config','配置SEO','0','269','60','1390032700');
INSERT INTO jh_system_module VALUES ('929','module','3','system/config','connect','接口参数设置','1','930','20','1390186485');
INSERT INTO jh_system_module VALUES ('930','menu','2','','','登录接口','1','71','50','1390188148');
INSERT INTO jh_system_module VALUES ('931','module','3','connect/connect','index','账号绑定记录','1','930','50','1390188435');
INSERT INTO jh_system_module VALUES ('932','module','3','connect/connect','delete','删除绑定记录','0','930','50','1390188435');
INSERT INTO jh_system_module VALUES ('933','module','3','connect/connect','so','搜索绑定记录','0','930','50','1390188435');
INSERT INTO jh_system_module VALUES ('934','module','3','connect/connect','edit','修改绑定记录','0','930','50','1390188609');
INSERT INTO jh_system_module VALUES ('935','module','3','designer/designer','doaudit','审核设计师','0','599','26','1390558114');
INSERT INTO jh_system_module VALUES ('936','menu','2','','','技工管理','1','71','40','1393984263');
INSERT INTO jh_system_module VALUES ('937','module','3','mechanic/mechanic','create','新增技工','0','936','50','1393984540');
INSERT INTO jh_system_module VALUES ('938','module','3','mechanic/mechanic','index','技工管理','1','936','40','1393984540');
INSERT INTO jh_system_module VALUES ('939','module','3','mechanic/mechanic','edit','编辑技工','0','936','50','1393984540');
INSERT INTO jh_system_module VALUES ('940','module','3','mechanic/mechanic','delete','删除技工','0','936','50','1393984540');
INSERT INTO jh_system_module VALUES ('941','module','3','mechanic/mechanic','so','搜索技工','0','936','50','1393984540');
INSERT INTO jh_system_module VALUES ('942','module','3','system/emailtmpl','config','配置模板','0','951','41','1401358903');
INSERT INTO jh_system_module VALUES ('943','module','3','system/smstmpl','config','配置模板','0','951','50','1401358950');
INSERT INTO jh_system_module VALUES ('944','module','3','mechanic/mechanic','doaudit','审核技工','0','936','50','1403260443');
INSERT INTO jh_system_module VALUES ('945','module','3','mechanic/yuyue','index','预约技工','1','936','50','1403260531');
INSERT INTO jh_system_module VALUES ('946','module','3','mechanic/yuyue','create','新增预约','0','936','50','1403260531');
INSERT INTO jh_system_module VALUES ('947','module','3','mechanic/yuyue','edit','修改预约','0','936','50','1403260531');
INSERT INTO jh_system_module VALUES ('948','module','3','mechanic/yuyue','delete','删除预约','0','936','50','1403260531');
INSERT INTO jh_system_module VALUES ('949','module','3','mechanic/yuyue','so','搜索预约','0','936','50','1403260531');
INSERT INTO jh_system_module VALUES ('950','menu','2','','','审核权限','1','71','50','1403261243');
INSERT INTO jh_system_module VALUES ('951','menu','2','','','通知设置','1','71','50','1403261297');
INSERT INTO jh_system_module VALUES ('952','module','3','activity/sign','activity','活动报名','0','571','11','1403681287');
INSERT INTO jh_system_module VALUES ('953','module','3','company/yuyue','detail','预约详情','0','59','50','1403776588');
INSERT INTO jh_system_module VALUES ('954','module','3','designer/yuyue','detail','预约详情','0','599','50','1403776612');
INSERT INTO jh_system_module VALUES ('955','module','3','mechanic/yuyue','detail','预约详情','0','936','50','1403776633');
INSERT INTO jh_system_module VALUES ('956','module','3','company/sign','detail','报名详情','0','59','40','1403776779');
INSERT INTO jh_system_module VALUES ('957','module','3','company/sign','youhui','优惠报名','0','59','50','1403779666');
INSERT INTO jh_system_module VALUES ('958','module','3','shop/yuyue','detail','查看预约','0','800','50','1403834030');
INSERT INTO jh_system_module VALUES ('1014','module','3','tools/database','restore','还原数据库','0','279','50','1413193393');
INSERT INTO jh_system_module VALUES ('1005','module','3','data/province','index','省份管理','1','296','10','1413173592');
INSERT INTO jh_system_module VALUES ('1025','module','3','member/group','index','管理用户组','1','72','50','1413947742');
INSERT INTO jh_system_module VALUES ('1024','module','3','block/block','code','推荐位代码','0','69','50','1413784156');
INSERT INTO jh_system_module VALUES ('1023','module','3','block/block','config','模板修改','0','69','50','1413776658');
INSERT INTO jh_system_module VALUES ('1022','module','3','system/theme','tmplsave','修改入库','0','670','50','1413447673');
INSERT INTO jh_system_module VALUES ('1021','module','3','system/theme','tmpldelbak','删除备份','0','670','50','1413429794');
INSERT INTO jh_system_module VALUES ('1020','module','3','system/theme','tmplrestore','还原模板','0','670','50','1413429248');
INSERT INTO jh_system_module VALUES ('1019','module','3','system/theme','tmplbak','查看备份','0','670','50','1413429248');
INSERT INTO jh_system_module VALUES ('1015','module','3','tools/database','optimize','优化数据库','0','279','50','1413193393');
INSERT INTO jh_system_module VALUES ('1016','module','3','adv/adv','config','广告位设置','0','68','50','1413384837');
INSERT INTO jh_system_module VALUES ('1018','module','3','system/theme','tmpledit','编辑模板','0','670','50','1413429248');
INSERT INTO jh_system_module VALUES ('1017','module','3','adv/adv','code','调用代码','0','68','50','1413384837');
INSERT INTO jh_system_module VALUES ('1013','module','3','tools/database','backdel','删除备份','0','279','50','1413193393');
INSERT INTO jh_system_module VALUES ('1012','module','3','tools/database','backlist','备份列表','0','279','50','1413193393');
INSERT INTO jh_system_module VALUES ('1011','module','3','tools/database','backup','备份数据库','0','279','50','1413193393');
INSERT INTO jh_system_module VALUES ('1010','module','3','data/city','province','省份城市','0','296','20','1413173592');
INSERT INTO jh_system_module VALUES ('1009','module','3','data/province','so','搜索省份','0','296','20','1413173592');
INSERT INTO jh_system_module VALUES ('1008','module','3','data/province','delete','删除省份','0','296','10','1413173592');
INSERT INTO jh_system_module VALUES ('1007','module','3','data/province','edit','修改省份','0','296','10','1413173592');
INSERT INTO jh_system_module VALUES ('1006','module','3','data/province','create','添加省份','0','296','10','1413173592');
INSERT INTO jh_system_module VALUES ('1131','module','3','fenzhan/admin','index','分站管理员','1','6','50','1420430348');
INSERT INTO jh_system_module VALUES ('991','module','3','company/news','doaudit','审核新闻','0','59','30','1407937210');
INSERT INTO jh_system_module VALUES ('992','module','3','article/article','doaudit','审核文章','0','85','13','1407937297');
INSERT INTO jh_system_module VALUES ('993','module','3','adv/item','doaudit','审核广告','0','68','50','1250176349');
INSERT INTO jh_system_module VALUES ('994','menu','2','','','商家结算','1','743','50','1409191163');
INSERT INTO jh_system_module VALUES ('995','module','3','shop/money','index','商家余额','0','994','50','1409191244');
INSERT INTO jh_system_module VALUES ('996','module','3','shop/money','shop','商铺日志','0','994','50','1409191244');
INSERT INTO jh_system_module VALUES ('997','module','3','shop/money','log','收支日志','1','994','50','1409191244');
INSERT INTO jh_system_module VALUES ('998','module','3','shop/money','tixian','商铺提现','0','994','50','1409191244');
INSERT INTO jh_system_module VALUES ('999','module','3','shop/money','chongzhi','充值现金','0','994','50','1409191244');
INSERT INTO jh_system_module VALUES ('1000','top','1','','','应用','1','0','50','1412492332');
INSERT INTO jh_system_module VALUES ('1002','menu','2','','','微信应用','1','1000','50','1412492369');
INSERT INTO jh_system_module VALUES ('1135','module','3','weixin/menu','towechat','同步菜单到公众平台','0','1002','50','1420430385');
INSERT INTO jh_system_module VALUES ('1026','module','3','member/group','create','添加用户组','0','72','50','1413947742');
INSERT INTO jh_system_module VALUES ('1027','module','3','member/group','edit','编辑用户组','0','72','50','1413947742');
INSERT INTO jh_system_module VALUES ('1028','module','3','member/group','priv','用户组权限','0','72','50','1413947742');
INSERT INTO jh_system_module VALUES ('1029','module','3','member/group','delete','删除用户组','0','72','50','1413947742');
INSERT INTO jh_system_module VALUES ('1030','module','3','tenders/tenders','detail','查看招标','0','669','50','1414213829');
INSERT INTO jh_system_module VALUES ('1031','module','3','case/case','dialog','案例列表','0','564','50','1414373760');
INSERT INTO jh_system_module VALUES ('1032','menu','2','','','工长管理','1','71','20','1414379239');
INSERT INTO jh_system_module VALUES ('1033','module','3','gz/gz','index','工长管理','1','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1034','module','3','gz/gz','create','添加工长','0','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1035','module','3','gz/gz','edit','修改工长','0','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1036','module','3','gz/gz','delete','删除工长','0','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1037','module','3','gz/gz','doaudit','审核工长','0','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1038','module','3','gz/gz','so','搜索工长','0','1032','50','1414381958');
INSERT INTO jh_system_module VALUES ('1039','module','3','gz/yuyue','index','预约管理','1','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1040','module','3','gz/yuyue','create','新增预约','0','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1041','module','3','gz/yuyue','edit','修改预约','0','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1042','module','3','gz/yuyue','delete','删除预约','0','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1043','module','3','gz/yuyue','detail','查看预约','0','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1044','module','3','gz/yuyue','so','搜索预约','0','1032','50','1414390381');
INSERT INTO jh_system_module VALUES ('1045','module','3','gz/gz','dialog','选择工长','0','1032','50','1414404945');
INSERT INTO jh_system_module VALUES ('1046','module','3','data/cate','index','分类设置','1','70','10','1414490528');
INSERT INTO jh_system_module VALUES ('1047','module','3','data/cate','create','添加分类','0','70','10','1414490528');
INSERT INTO jh_system_module VALUES ('1048','module','3','data/cate','update','更新分类','0','70','10','1414490528');
INSERT INTO jh_system_module VALUES ('1049','module','3','data/cate','delete','删除分类','0','70','10','1414490528');
INSERT INTO jh_system_module VALUES ('1050','module','3','diary/diary','dialog','选择日记','0','751','50','1414498105');
INSERT INTO jh_system_module VALUES ('1051','module','3','designer/comment','index','评论管理','1','599','50','1414508233');
INSERT INTO jh_system_module VALUES ('1052','module','3','designer/comment','edit','修改评论','0','599','50','1414508233');
INSERT INTO jh_system_module VALUES ('1053','module','3','designer/comment','reply','回复评论','0','599','50','1414508233');
INSERT INTO jh_system_module VALUES ('1054','module','3','designer/comment','doaudit','审核评论','0','599','50','1414508233');
INSERT INTO jh_system_module VALUES ('1055','module','3','designer/comment','delete','审核评论','0','599','50','1414508233');
INSERT INTO jh_system_module VALUES ('1059','module','3','gz/comment','create','添加评论','0','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1058','module','3','gz/comment','index','评论管理','1','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1060','module','3','gz/comment','edit','修改评论','0','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1061','module','3','gz/comment','reply','回复评论','0','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1062','module','3','gz/comment','delete','删除评论','0','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1063','module','3','gz/comment','so','搜索评论','0','1032','50','1414580310');
INSERT INTO jh_system_module VALUES ('1064','module','3','designer/article','index','设计师文章','0','599','50','1416036645');
INSERT INTO jh_system_module VALUES ('1065','module','3','designer/article','create','设计师文章添加','0','599','50','1416036695');
INSERT INTO jh_system_module VALUES ('1066','module','3','designer/article','edit','设计师文章修改','0','599','50','1416036746');
INSERT INTO jh_system_module VALUES ('1067','module','3','designer/article','delete','设计师文章删除','0','599','50','1416036801');
INSERT INTO jh_system_module VALUES ('1068','module','3','designer/article','doaudit','设计师文章审核','0','599','50','1416041150');
INSERT INTO jh_system_module VALUES ('1100','module','3','designer/article','items','设计师文章列表','1','599','50','1419666575');
INSERT INTO jh_system_module VALUES ('1072','module','3','zxb/zxb','delete','装修保删除','0','1069','50','1417418734');
INSERT INTO jh_system_module VALUES ('1073','module','3','zxb/zxb','edit','装修保修改','0','1069','50','1417418734');
INSERT INTO jh_system_module VALUES ('1074','module','3','zxb/zxb','doaudit','批量审核','0','1069','50','1417418734');
INSERT INTO jh_system_module VALUES ('1075','module','3','system/config','zxb','装修保配置','1','1069','50','1417425841');
INSERT INTO jh_system_module VALUES ('1093','module','3','product/spec','update','更新规格','0','744','50','1418355094');
INSERT INTO jh_system_module VALUES ('1092','module','3','product/spec','product','商品规格','0','744','50','1418355094');
INSERT INTO jh_system_module VALUES ('1078','module','3','zxb/hetong','edit','装修保合同修改','0','1069','50','1417579077');
INSERT INTO jh_system_module VALUES ('1091','module','3','zxb/plaint','delete','投诉删除','0','1069','50','1418004704');
INSERT INTO jh_system_module VALUES ('1080','module','3','zxb/step','index','装修保流程','0','1069','50','1417662883');
INSERT INTO jh_system_module VALUES ('1090','module','3','zxb/plaint','edit','投诉修改','0','1069','50','1418004704');
INSERT INTO jh_system_module VALUES ('1082','module','3','zxb/step','edit','装修保流程修改','0','1069','50','1417662883');
INSERT INTO jh_system_module VALUES ('1089','module','3','zxb/plaint','create','投诉添加','0','1069','50','1418004704');
INSERT INTO jh_system_module VALUES ('1088','module','3','zxb/plaint','index','投诉列表','1','1069','50','1418004704');
INSERT INTO jh_system_module VALUES ('1085','module','3','zxb/zxb','dialog','装修保选择','0','1069','50','1417672836');
INSERT INTO jh_system_module VALUES ('1094','module','3','product/spec','delete','删除规格','0','744','50','1418355094');
INSERT INTO jh_system_module VALUES ('1087','module','3','zxb/zxb','step','装修保流程','0','1069','50','1417849715');
INSERT INTO jh_system_module VALUES ('1096','module','3','system/config','access','访问设置','1','269','50','1419059027');
INSERT INTO jh_system_module VALUES ('1097','module','3','system/config','comment','评论设置','1','269','8','1419222593');
INSERT INTO jh_system_module VALUES ('1098','module','3','system/config','routeurl','URL设置','1','269','50','1419417345');
INSERT INTO jh_system_module VALUES ('1099','module','3','system/config','domain','域名设置','1','269','50','1419418242');
INSERT INTO jh_system_module VALUES ('1101','module','3','gz/comment','doaudit','评论审核','0','1032','50','1419670884');
INSERT INTO jh_system_module VALUES ('1102','module','3','weixin/weixin','index','会员公众号','1','1002','50','1419677951');
INSERT INTO jh_system_module VALUES ('1103','module','3','weixin/weixin','create','添加公众号','0','1002','50','1419677951');
INSERT INTO jh_system_module VALUES ('1104','module','3','weixin/weixin','edit','修改公众号','0','1002','50','1419677951');
INSERT INTO jh_system_module VALUES ('1105','module','3','weixin/weixin','delete','删除公众号','0','1002','50','1419677951');
INSERT INTO jh_system_module VALUES ('1106','module','3','weixin/weixin','leaflets','推广页设置','0','1002','50','1419677951');
INSERT INTO jh_system_module VALUES ('1107','module','3','weixin/reply','index','素材管理','1','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1108','module','3','weixin/reply','create','添加素材','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1109','module','3','weixin/reply','edit','修改素材','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1110','module','3','weixin/reply','delete','删除素材','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1111','module','3','weixin/reply','dialog','选择素材','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1112','module','3','weixin/keyword','index','关键字管理','1','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1113','module','3','weixin/keyword','create','添加关键字','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1114','module','3','weixin/keyword','edit','修改关键字','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1115','module','3','weixin/keyword','delete','删除关键字','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1116','module','3','weixin/keyword','so','搜索关键字','0','1002','50','1419678104');
INSERT INTO jh_system_module VALUES ('1117','module','3','weixin/weixin','menu','公众号菜单','0','1002','50','1419745674');
INSERT INTO jh_system_module VALUES ('1118','module','3','weixin/menu','create','添加菜单','0','1002','50','1419746154');
INSERT INTO jh_system_module VALUES ('1119','module','3','weixin/menu','edit','修改菜单','0','1002','50','1419746154');
INSERT INTO jh_system_module VALUES ('1120','module','3','weixin/menu','delete','删除菜单','0','1002','50','1419746154');
INSERT INTO jh_system_module VALUES ('1122','module','3','activity/activity','doaudit','批量审核','0','571','50','1419848467');
INSERT INTO jh_system_module VALUES ('1123','module','3','home/site','doaudit','批量审核','0','432','50','1419908803');
INSERT INTO jh_system_module VALUES ('1126','module','3','weixin/weixin','welcome','欢迎页设置','0','1002','50','1419942869');
INSERT INTO jh_system_module VALUES ('1127','module','3','weixin/weixin','reply','公众号素材','0','1002','50','1419945038');
INSERT INTO jh_system_module VALUES ('1128','module','3','weixin/weixin','keyword','公众号关键字','0','1002','50','1419945038');
INSERT INTO jh_system_module VALUES ('1129','module','3','tenders/track','reply','跟踪回复','0','669','50','1420078992');
INSERT INTO jh_system_module VALUES ('1130','module','3','system/config','wechat','微信配置','1','1002','5','1420386712');
INSERT INTO jh_system_module VALUES ('1132','module','3','fenzhan/admin','create','分站管理员添加','0','6','50','1420430348');
INSERT INTO jh_system_module VALUES ('1133','module','3','fenzhan/admin','edit','分站管理员修改','0','6','50','1420430348');
INSERT INTO jh_system_module VALUES ('1134','module','3','fenzhan/admin','delete','分站管理员删除','0','6','50','1420430348');
INSERT INTO jh_system_module VALUES ('1136','module','3','fenzhan/admin','save','保存分站管理员','0','6','50','1420431163');
INSERT INTO jh_system_module VALUES ('1137','module','3','home/home','doaudit','小区审核','0','432','50','1423039786');
INSERT INTO jh_system_module VALUES ('1138','module','3','shop/mendian','create','添加门店','0','600','50','1423206709');
INSERT INTO jh_system_module VALUES ('1139','module','3','shop/mendian','edit','修改门店','0','600','50','1423206709');
INSERT INTO jh_system_module VALUES ('1140','module','3','shop/mendian','delete','删除门店','0','600','50','1423206709');
INSERT INTO jh_system_module VALUES ('1141','module','3','shop/mendian','so','搜索门店','0','600','50','1423206709');
INSERT INTO jh_system_module VALUES ('1142','module','3','shop/mendian','index','门店管理','1','600','50','1423206818');
INSERT INTO jh_system_module VALUES ('1143','module','3','shop/mendian','doaudit','审核门店','0','600','50','1423211560');
INSERT INTO jh_system_module VALUES ('1144','module','3','home/package','delete','删除套餐','0','432','50','1423899888');
INSERT INTO jh_system_module VALUES ('1154','module','3','weixin/scratch','index','刮刮卡管理','1','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1155','module','3','weixin/scratch','create','刮刮卡添加','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1156','module','3','weixin/scratch','edit','刮刮卡修改','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1157','module','3','weixin/scratch','delete','刮刮卡删除','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1158','module','3','weixin/scratchsn','items','刮刮卡中奖管理','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1159','module','3','weixin/scratchsn','create','刮刮卡中奖添加','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1160','module','3','weixin/scratchsn','edit','刮刮卡中奖修改','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1161','module','3','weixin/scratchsn','delete','刮刮卡中奖删除','0','1002','50','1428574113');
INSERT INTO jh_system_module VALUES ('1162','module','3','weixin/prize','items','刮刮卡奖品','0','1002','50','1428663636');
INSERT INTO jh_system_module VALUES ('1163','module','3','weixin/prize','edit','刮刮卡奖品修改','0','1002','50','1428663636');
INSERT INTO jh_system_module VALUES ('1164','module','3','weixin/prize','delete','刮刮卡奖品删除','0','1002','50','1428663636');
INSERT INTO jh_system_module VALUES ('1165','module','3','weixin/prize','create','刮刮卡奖品添加','0','1002','50','1428663636');
INSERT INTO jh_system_module VALUES ('1166','module','3','weixin/lottery','index','大转盘管理','1','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1167','module','3','weixin/lottery','create','大转盘添加','0','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1168','module','3','weixin/lottery','edit','大转盘修改','0','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1169','module','3','weixin/lottery','delete','大转盘删除','0','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1170','module','3','weixin/lotterysn','items','大转盘中奖管理','0','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1171','module','3','weixin/lotterysn','create','大转盘中奖添加','0','1002','50','1428913235');
INSERT INTO jh_system_module VALUES ('1172','module','3','weixin/lotterysn','edit','大转盘中奖修改','0','1002','50','1428916489');
INSERT INTO jh_system_module VALUES ('1173','module','3','weixin/lotterysn','delete','大转盘中奖删除','0','1002','50','1428916489');
INSERT INTO jh_system_module VALUES ('1174','module','3','weixin/goldegg','index','砸金蛋管理','1','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1175','module','3','weixin/goldegg','create','砸金蛋添加','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1176','module','3','weixin/goldegg','edit','砸金蛋修改','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1177','module','3','weixin/goldegg','delete','砸金蛋删除','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1178','module','3','weixin/goldeggsn','items','砸金蛋中奖管理','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1179','module','3','weixin/goldeggsn','create','砸金蛋中奖添加','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1180','module','3','weixin/goldeggsn','edit','砸金蛋中奖修改','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1181','module','3','weixin/goldeggsn','delete','砸金蛋中奖删除','0','1002','50','1429172506');
INSERT INTO jh_system_module VALUES ('1182','module','3','article/article','upload','上传图片','0','85','12','1419942069');
INSERT INTO jh_system_module VALUES ('1183','module','3','adv/item','index','内容管理','1','68','50','1431152244');
INSERT INTO jh_system_module VALUES ('1184','module','3','adv/item','so','搜索内容','0','68','50','1431167794');
INSERT INTO jh_system_module VALUES ('1185','module','3','zxb/zxb','change_zxb','转为装修保','0','1069','50','1432177426');
INSERT INTO jh_system_module VALUES ('1186','menu','2','','','报价属性管理','1','392','50','1433823112');
INSERT INTO jh_system_module VALUES ('1187','module','3','price/attrfrom','create','添加报价属性分类','0','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1188','module','3','price/attrfrom','edit','修改报价属性分类','0','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1189','module','3','price/attr','index','报价属性列表','1','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1190','module','3','price/attr','create','添加报价属性','0','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1191','module','3','price/attr','edit','修改报价属性','0','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1192','module','3','price/attr','delete','删除报价属性','0','1186','50','1433823288');
INSERT INTO jh_system_module VALUES ('1193','module','3','price/attrfrom','delete','删除报价属性分类','0','1186','50','1433823299');
INSERT INTO jh_system_module VALUES ('1194','module','3','price/attrfrom','index','报价属性分类','1','1186','40','1433823318');
INSERT INTO jh_system_module VALUES ('1195','module','3','supervist/supervist','index','监理管理','1','1200','50','1420424752');
INSERT INTO jh_system_module VALUES ('1196','module','3','supervist/supervist','create','监理添加','0','1200','50','1420424752');
INSERT INTO jh_system_module VALUES ('1197','module','3','supervist/supervist','delete','监理删除','0','1200','50','1420424752');
INSERT INTO jh_system_module VALUES ('1198','module','3','supervist/supervist','edit','监理修改','0','1200','50','1420424752');
INSERT INTO jh_system_module VALUES ('1199','module','3','supervist/supervist','so','监理搜索','0','1200','50','1420424752');
INSERT INTO jh_system_module VALUES ('1200','menu','2','','','监理管理','1','71','50','1420424631');
INSERT INTO jh_system_module VALUES ('1218','module','3','system/config','fenxiao','积分配置','1','269','50','1449473167');
INSERT INTO jh_system_module VALUES ('1231','menu','2','','','积分商城','1','392','50','1452752878');
INSERT INTO jh_system_module VALUES ('1232','module','3','jfproduct/product','index','商品列表','1','1231','50','1452753167');
INSERT INTO jh_system_module VALUES ('1233','module','3','jfproduct/product','create','添加商品','0','1231','50','1452753167');
INSERT INTO jh_system_module VALUES ('1234','module','3','jfproduct/product','delete','删除商品','0','1231','50','1452753167');
INSERT INTO jh_system_module VALUES ('1235','module','3','jfproduct/product','edit','修改商品','0','1231','50','1452753167');
INSERT INTO jh_system_module VALUES ('1236','module','3','jfproduct/product','detail','商品详情','0','1231','50','1452753167');
INSERT INTO jh_system_module VALUES ('1237','module','3','jfproduct/product','doaudit','审核商品','0','1231','50','1452753997');
INSERT INTO jh_system_module VALUES ('1238','module','3','jfproduct/product','so','搜索','0','1231','50','1452753997');
INSERT INTO jh_system_module VALUES ('1239','module','3','jfproduct/product','select_cate','分类选择','0','1231','50','1452755150');
INSERT INTO jh_system_module VALUES ('1240','module','3','trade/jforder','index','发货管理','1','1231','50','1452932416');
INSERT INTO jh_system_module VALUES ('1241','module','3','trade/jforder','detail','订单详情','0','1231','50','1452932416');
INSERT INTO jh_system_module VALUES ('1242','module','3','trade/jforder','so','订单搜索','0','1231','50','1452932416');
INSERT INTO jh_system_module VALUES ('1243','module','3','trade/jforder','delete','订单删除','0','1231','50','1452932416');
INSERT INTO jh_system_module VALUES ('1244','module','3','trade/jforder','cancle','取消','0','1231','50','1452932818');
INSERT INTO jh_system_module VALUES ('1246','module','3','trade/jforder','sendout','设置发货','0','1231','50','1452933635');
INSERT INTO jh_system_module VALUES ('1247','module','3','truste/cate','index','分类管理','1','1254','20','1385634862');
INSERT INTO jh_system_module VALUES ('1248','module','3','truste/cate','create','添加分类','0','1254','21','1385634862');
INSERT INTO jh_system_module VALUES ('1249','module','3','truste/cate','edit','修改分类','0','1254','22','1385634862');
INSERT INTO jh_system_module VALUES ('1250','module','3','truste/cate','so','搜索分类','0','1254','23','1385634862');
INSERT INTO jh_system_module VALUES ('1251','module','3','truste/cate','doaudit','审核分类','0','1254','24','1385634862');
INSERT INTO jh_system_module VALUES ('1252','module','3','truste/cate','delete','删除分类','0','1254','25','1385634862');
INSERT INTO jh_system_module VALUES ('1253','module','3','truste/cate','children','招标子分类','0','1254','25','1385977686');
INSERT INTO jh_system_module VALUES ('1256','module','3','truste/truste','index','维修管理','1','1254','50','1384826638');
INSERT INTO jh_system_module VALUES ('1254','menu','2','','','装修维修','1','392','50','1453253813');
INSERT INTO jh_system_module VALUES ('1255','module','3','system/config','weixiu','维修配置','1','1254','50','1453253939');
INSERT INTO jh_system_module VALUES ('1257','module','3','truste/truste','detail','查看维修','0','1254','50','1384826638');
INSERT INTO jh_system_module VALUES ('1258','module','3','truste/truste','edit','编辑维修','0','1254','50','1384826638');
INSERT INTO jh_system_module VALUES ('1259','module','3','truste/truste','delete','删除维修','0','1254','50','1384826638');
INSERT INTO jh_system_module VALUES ('1260','module','3','truste/truste','so','搜索维修','0','1254','50','1384826638');
INSERT INTO jh_system_module VALUES ('1261','module','3','truste/look','index','竞标管理','0','1254','50','1384845748');
INSERT INTO jh_system_module VALUES ('1262','module','3','truste/look','create','分标操作','0','1254','50','1384845748');
INSERT INTO jh_system_module VALUES ('1263','module','3','truste/look','update','更新分标','0','1254','50','1384910383');
INSERT INTO jh_system_module VALUES ('1264','menu','2','','','装修贷款','1','392','50','1453269554');
INSERT INTO jh_system_module VALUES ('1265','module','3','topics/topics','index','贷款列表','1','1264','50','1453269696');
INSERT INTO jh_system_module VALUES ('1266','module','3','topics/topics','delete','删除','0','1264','50','1453269696');
INSERT INTO jh_system_module VALUES ('1267','module','3','topics/topics','detail','贷款详情','0','1264','50','1453269696');
INSERT INTO jh_system_module VALUES ('1268','module','3','topics/topics','edit','编辑','0','1264','50','1453269696');
INSERT INTO jh_system_module VALUES ('1269','module','3','topics/topics','so','搜索','0','1264','50','1453270015');
INSERT INTO jh_system_module VALUES ('1271','module','3','shop/money','audit','审核通过','0','994','50','1453282521');
INSERT INTO jh_system_module VALUES ('1279','module','3','sms/log','index','短信日志','1','951','50','1453967456');
DROP TABLE IF EXISTS jh_systmpl;
CREATE TABLE `jh_systmpl` (
  `systmpl_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `from` enum('seo','sms','mail') DEFAULT NULL,
  `key` varchar(50) DEFAULT '',
  `intro` varchar(1024) DEFAULT NULL,
  `tmpl` mediumtext,
  `tmpl1` mediumtext,
  `tmpl2` mediumtext,
  `dateline` int(10) DEFAULT '0',
  `is_open` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`systmpl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 AUTO_INCREMENT=116;

INSERT INTO jh_systmpl VALUES ('1','业主:发布装修招标','sms','sms_tenders','a:2:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";}','亲，您的装修招标提交成功，装修助理稍后会与您取得联系，电话：{site_phone}【{site_title}】','','','1387876702','1');
INSERT INTO jh_systmpl VALUES ('3','业主:预约查看工地','sms','sms_site_yuyue','a:2:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";}','尊敬的{contact}您好，您于{dateline}预约了\"{company_name}\"的工地\"{site}\"！预祝您装修快乐！【{site_title}】','','','1387877342','1');
INSERT INTO jh_systmpl VALUES ('89','预约参观工地','mail','mail_company_site','a:7:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:4:\"site\";s:6:\"工地\";s:13:\"company_title\";s:12:\"公司标题\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','{site_title}-预约参观工地','<p>\r\n	亲爱的 <strong>{company_name}</strong>:<br />\r\n<br />\r\n</p>\r\n<p>\r\n	{contact}预约了查看工地:{site}， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403342749','1');
INSERT INTO jh_systmpl VALUES ('2','业主:预约设计师','sms','sms_designer_yuyue','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"designer\";s:9:\"设计师\";}','尊敬的{contact}您于{dateline}预约了设计师\"{designer}\"给您设计房屋装修！预祝您装修愉快！【{site_title}】','','','1387877024','1');
INSERT INTO jh_systmpl VALUES ('4','业主:预约安防智能公司','sms','sms_company_yuyue','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','尊敬的{contact}，您于{dateline}预约了{company_name}的装修服务！稍后商家会联系您！预祝装修愉快！【{site_title}】','','','1387877547','1');
INSERT INTO jh_systmpl VALUES ('5','公司:预约设计师','sms','sms_designer_tongzhi','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"designer\";s:9:\"设计师\";}','尊敬的{designer}，业主{contact}预约了您的设计！手机号：{mobile}；祝您签单成功！【{site_title}】','','','1387878010','1');
INSERT INTO jh_systmpl VALUES ('6','公司:预约安防智能公司','sms','sms_company_tongzhi','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','尊敬的{company_name}，业主{contact}预约了您的装修服务！手机号：{mobile}预祝合作成功！【{site_title}】','','','1387936307','1');
INSERT INTO jh_systmpl VALUES ('8','业主:网站活动报名','sms','sms_activity_yezhu','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"activity\";s:6:\"活动\";}','尊敬的{contact}您好，您于{dateline}报名参加了\"{activity}\"活动!稍后装修管家会与您进行确认！【{site_title}】','','','1387936873','1');
INSERT INTO jh_systmpl VALUES ('9','业主:报名优惠活动','sms','sms_youhui_yuyue','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:6:\"youhui\";s:12:\"优惠活动\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','尊敬的{contact}您于{dateline}预约了{company_name}的装修优惠活动\"{youhui}\"!预祝您装修愉快!【{site_title}】','','','1387937479','1');
INSERT INTO jh_systmpl VALUES ('10','公司:报名优惠活动','sms','sms_youhui_tongzhi','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:6:\"youhui\";s:12:\"优惠活动\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','尊敬的{company_name}，业主{contact}于{dateline}预约了您的装修优惠活动“{youhui}”,手机号:{mobile}！预祝大赚【{site_title}】','','','1387937655','1');
INSERT INTO jh_systmpl VALUES ('17','城市切换页面','seo','seo_city','a:0:{}','城市切换页面_{site_title}','合肥装修网、安防智能公司排名、装修业主网、小区团装网、{site_title}装修网','{site_title}是最好的业主装修网，装修最省心的网站！服务热线{site_phone}!','1388047427','1');
INSERT INTO jh_systmpl VALUES ('11','站长:发布装修招标','sms','sms_admin_tenders','a:2:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";}','亲爱的管理员！{contact}于{dateline}在您的网站发布了招标信息，手机号:\r\n{mobile}!【{site_title}】','','','1387954776','1');
INSERT INTO jh_systmpl VALUES ('12','站长:报名网站活动','sms','sms_admin_activity','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"activity\";s:12:\"活动名称\";}','亲爱的管理员！{contact}于{dateline}报名了{activity}活动！手机号：{mobile}!【{site_title}】','','','1387955762','1');
INSERT INTO jh_systmpl VALUES ('13','会员:手机认证短信','sms','sms_verify_mobile','a:3:{s:5:\"uname\";s:9:\"会员名\";s:6:\"mobile\";s:9:\"手机号\";s:11:\"verify_code\";s:9:\"验证码\";}','亲爱的{uname}，你正在进行手机验证，你的验证码是:{verify_code}。【{site_title}】','','','1387959672','1');
INSERT INTO jh_systmpl VALUES ('14','公司:分标通知安防智能公司','sms','sms_admin_company_tenders','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','尊敬的{company_name}您好,管理员将业主{contact},手机号{mobile}的装修招标分配于您！预祝您大赚！【{site_title}】','','','1388024214','1');
INSERT INTO jh_systmpl VALUES ('15','会员邮箱认证','mail','mail_member_verify','a:2:{s:5:\"uname\";s:9:\"会员名\";s:11:\"verify_link\";s:12:\"验证连接\";}','{site_title}-邮箱认证','<p>\r\n	尊敬的{uname}:\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp; &nbsp; 您好! 您在{site_title}申请了邮件认证！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp; &nbsp; 复制链接：{verify_link}&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp; &nbsp; 在浏览器打开即可完成验证！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"http://www.jhcms.cn/admin/%7Bsite_url%7D\" target=\"_blank\">{site_title}</a>！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>','','1388026633','1');
INSERT INTO jh_systmpl VALUES ('16','会员找回密码','mail','mail_member_forgot','a:2:{s:5:\"uname\";s:9:\"会员名\";s:11:\"forgot_link\";s:12:\"验证链接\";}','{site_title}-找回密码','<p>\r\n	<span style=\"font-family:\'lucida Grande\', Verdana;font-size:14px;background-color:#FFFFFF;\">亲爱的</span><strong>{uname}</strong><span style=\"font-family:\'lucida Grande\', Verdana;font-size:14px;background-color:#FFFFFF;\">:</span><br />\r\n<br />\r\n<span style=\"font-family:\'lucida Grande\', Verdana;font-size:14px;background-color:#FFFFFF;\"> 您好！感谢您使用{site_title}</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-family:\'lucida Grande\', Verdana;font-size:14px;line-height:23px;background-color:#FFFFFF;\">您只需要点击以下链接就可以修改密码了！</span> \r\n</p>\r\n<p>\r\n	复制链接：<a href=\"{forgot_link}\" target=\"_blank\">{forgot_link}</a> \r\n</p>\r\n<p>\r\n	如果无法打开连接请复制连接到在浏览器打开即可！\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1388040012','1');
INSERT INTO jh_systmpl VALUES ('18','主网站首页','seo','seo_index','a:0:{}','{city_seo_title}_最新装修效果图大全_装修服务一站式平台！','{city_seo_keywords}','{city_seo_description}','1388047689','1');
INSERT INTO jh_systmpl VALUES ('19','我要装修主页','seo','seo_tenders','a:0:{}','我要装修_{city_seo_title}_{site_title}','我要装修','{site_title}是{city_name}最好的装修招标网!服务热线{site_phone}','1388050223','1');
INSERT INTO jh_systmpl VALUES ('20','我要装修的招标详情页','seo','seo_tenders_detail','a:1:{s:5:\"title\";s:12:\"招标标题\";}','{title}_我要装修_{site_title}','{title}','{title}-{sitename}是{area_name}装修招标最好的选择！','1388050869','1');
INSERT INTO jh_systmpl VALUES ('21','找公司地图','seo','seo_gs_maps','a:0:{}','选{city_name}安防智能公司就上{sitename}来寻找!_{sitename}','{city_name}安防智能公司排行,{city_name}哪家安防智能公司好','选{city_name}安防智能公司就上{sitename}来寻找！服务热线{phone}','1388108910','1');
INSERT INTO jh_systmpl VALUES ('22','安防智能公司列表页面','seo','seo_gs_items','a:3:{s:9:\"area_name\";s:6:\"地区\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','{city_name}{area_name}{attr}{page}安防智能公司_哪家安防智能公司好？','{city_name}{area_name}哪家安防智能公司好、{city_name}{area_name}安防智能公司\r\n','{city_name}{area_name}哪家安防智能公司好？{sitename}告诉您答案！服务热线{phone}','1388109225','1');
INSERT INTO jh_systmpl VALUES ('23','安防智能公司商铺首页','seo','seo_company','a:7:{s:13:\"company_title\";s:12:\"公司全称\";s:12:\"company_name\";s:12:\"名称简称\";s:13:\"company_photo\";s:12:\"公司电话\";s:12:\"company_desc\";s:12:\"公司介绍\";s:17:\"company_seo_title\";s:15:\"公司SEO标题\";s:20:\"company_seo_keywords\";s:18:\"公司SEO关键字\";s:23:\"company_seo_description\";s:15:\"公司SEO描述\";}','{company_name}_{company_title}_{site_title}','{company_name},{company_title}','{company_desc}','1388109667','1');
INSERT INTO jh_systmpl VALUES ('29','本地新闻','seo','seo_news_items','a:1:{s:4:\"page\";s:6:\"页码\";}','{city_name}_本地资讯_{site_title}','{city_name}_本地资讯_{site_title}','{site_desc}','1388110877','1');
INSERT INTO jh_systmpl VALUES ('107','手机版设置','seo','seo_mobile','a:0:{}','','','','1423461819','1');
INSERT INTO jh_systmpl VALUES ('30','新闻详情','seo','seo_news_detail','a:3:{s:5:\"title\";s:6:\"标题\";s:9:\"news_desc\";s:6:\"描述\";s:12:\"company_name\";s:6:\"公司\";}','{title}-{company_name}-{sitename}','{title}-{company_name}-{sitename}','{title}-{company_name}-{sitename}','1388111279','1');
INSERT INTO jh_systmpl VALUES ('32','设计师列表','seo','seo_designer','a:3:{s:9:\"area_name\";s:6:\"地区\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','{city_name}{area_name}装修设计师_{sitename}','{city_name}{area_name}有哪些好的设计师？{sitename}告诉您答案！服务热线{phone}','{city_name}{area_name}有哪些好的设计师？{sitename}告诉您答案！服务热线{phone}','1388111500','1');
INSERT INTO jh_systmpl VALUES ('33','设计师详情页面（博客）','seo','seo_designer_detail','a:4:{s:13:\"designer_name\";s:15:\"设计师名字\";s:15:\"designer_slogan\";s:12:\"设计理念\";s:15:\"designer_school\";s:12:\"毕业院校\";s:13:\"designer_desc\";s:15:\"设计师介绍\";}','装修设计师{designer_name}的博客_{site_title}','设计师{designer_name}的博客-{site_title}','设计师{designer_name}的博客-{designer_desc}','1388111748','1');
INSERT INTO jh_systmpl VALUES ('34','优惠信息列表页','seo','seo_youhui','a:1:{s:4:\"page\";s:6:\"页码\";}','{city_name}装修优惠活动-{site_title}','{city_name}装修优惠活动-{site_title}','{city_name}装修优惠活动-{site_title}','1388111860','1');
INSERT INTO jh_systmpl VALUES ('35','优惠信息详情页面','seo','seo_youhui_detail','a:3:{s:5:\"title\";s:12:\"优惠标题\";s:11:\"youhui_desc\";s:12:\"优惠描述\";s:12:\"company_name\";s:12:\"公司名称\";}','{title}_{company_name}_{site_title}','{title}_{company_name}_优惠信息','{title}_{youhui_desc}','1388112020','1');
INSERT INTO jh_systmpl VALUES ('37','我搜我家小区列表页','seo','seo_home_items','a:3:{s:9:\"area_name\";s:6:\"区域\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"分页\";}','{city_name}{area_name}{attr}小区列表','{city_name}小区列表','{city_name}小区列表','1388112543','1');
INSERT INTO jh_systmpl VALUES ('38','小区详情页首页','seo','seo_home_detail','a:1:{s:9:\"home_name\";s:9:\"小区名\";}','{home_name}-{sitename}','{home_name}-{sitename}','{home_name}-{sitename}','1388112717','1');
INSERT INTO jh_systmpl VALUES ('43','小区地图','seo','seo_home_maps','a:0:{}','{city_name}楼盘小区地图分布_{sitename}','{city_name}小区地图','{city_name}小区地图','1388113900','1');
INSERT INTO jh_systmpl VALUES ('44','效果图列表','seo','seo_case','a:2:{s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','装修效果图大全_厨房,客厅,卫生间,阳台,中式,简欧装修效果图图片欣赏-{sitename}','装修效果图大全_厨房,客厅,卫生间,阳台,中式,简欧装修效果图欣赏','装修效果图大全_厨房,客厅,卫生间,阳台,中式,简欧装修效果图欣赏-{sitename}','1388114008','1');
INSERT INTO jh_systmpl VALUES ('45','效果图详情','seo','seo_case_detail','a:4:{s:5:\"title\";s:6:\"标题\";s:9:\"seo_title\";s:9:\"seo标题\";s:12:\"seo_keywords\";s:9:\"关键字\";s:15:\"seo_description\";s:6:\"描述\";}','{title}-装修案例效果图大全_{seo_title}','{seo_keywords}','{seo_description}','1388114421','1');
INSERT INTO jh_systmpl VALUES ('46','学装修聚合页','seo','seo_article','a:0:{}','装修知识技巧大全_装修流程_装修风水知识-{sitename}','学装修-{sitename}','学装修-{sitename}','1388114523','1');
INSERT INTO jh_systmpl VALUES ('47','学装修列表页','seo','seo_article_items','a:4:{s:9:\"cate_name\";s:12:\"分类名称\";s:14:\"cate_seo_title\";s:15:\"分类SEO标题\";s:17:\"cate_seo_keywords\";s:18:\"分类SEO关键字\";s:20:\"cate_seo_description\";s:15:\"分类SEO描述\";}','{cate_title}_装修知识大全-{sitename}','{cate_title}相关内容-{sitename}','{cate_title}相关内容-{sitename}','1388114825','1');
INSERT INTO jh_systmpl VALUES ('48','学装修详情页面','seo','seo_article_detail','a:4:{s:5:\"title\";s:12:\"文章标题\";s:12:\"article_desc\";s:12:\"文章描述\";s:9:\"cate_name\";s:9:\"分类名\";s:4:\"page\";s:6:\"页码\";}','{title}_装修知识大全_{sitename}','{seo_keywords}','{seo_description}','1388123802','1');
INSERT INTO jh_systmpl VALUES ('49','装修日记列表页','seo','seo_diary_items','a:3:{s:6:\"status\";s:6:\"阶段\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','装修日记_{sitename}','{sitename}最真实的装修日记记录','{sitename}最真实的装修日记记录','1388123897','1');
INSERT INTO jh_systmpl VALUES ('50','装修日记详情','seo','seo_diary_detail','a:3:{s:5:\"title\";s:12:\"日记标题\";s:9:\"home_name\";s:12:\"小区名称\";s:12:\"company_name\";s:12:\"公司名称\";}','{home_name}装修日记_{sitename}','{home_name}装修日记','业主{uname}请{company_name}装修{home_name}的日记真实记录','1388124347','1');
INSERT INTO jh_systmpl VALUES ('51','问答首页','seo','seo_ask','a:0:{}','装修知识技巧大全_装修知识问答-{site_title}','装修知识技巧大全，装修知识问答','装修知识技巧大全_装修知识问答-{site_title}','1388124866','1');
INSERT INTO jh_systmpl VALUES ('52','问答列表页','seo','seo_ask_items','a:1:{s:9:\"cate_name\";s:9:\"分类名\";}','{cate_name}_装修知识技巧大全_{site_title}','{cate_name},装修知识技巧大全','{cate_name}_装修知识技巧大全','1388125037','1');
INSERT INTO jh_systmpl VALUES ('53','问答详情页','seo','seo_ask_detail','a:2:{s:5:\"title\";s:6:\"标题\";s:5:\"intro\";s:6:\"内容\";}','{title}_装修知识大全_{sitename}','{title},装修知识大全','{title}_装修知识大全_{sitename}','1388125700','1');
INSERT INTO jh_systmpl VALUES ('54','活动列表','seo','seo_activity','a:4:{s:9:\"cate_name\";s:9:\"分类名\";s:14:\"cate_seo_title\";s:15:\"分类SEO标题\";s:17:\"cate_seo_keywords\";s:18:\"分类SEO关键字\";s:20:\"cate_seo_description\";s:15:\"分类SEO描述\";}','装修促销活动_建材打折优惠_{sitename}','装修促销活动,建材打折优惠','{site_title}{cate_title}活动{cate_seo_description}','1388126515','1');
INSERT INTO jh_systmpl VALUES ('55','活动详情页面','seo','seo_activity_detail','a:3:{s:5:\"title\";s:12:\"活动标题\";s:5:\"intro\";s:12:\"活动描述\";s:9:\"cate_name\";s:9:\"分类名\";}','{title}_装修活动_{sitename}','{seo_keywords}','{seo_description}','1388126949','1');
INSERT INTO jh_systmpl VALUES ('56','商城首页SEO设置','seo','seo_mall','a:0:{}','购买装修材料，家具，软装配饰等，就上{sitename}商城！','{sitename}商城是{city_name}最大的商城系统','{sitename}商城是{city_name}最大的商城系统','1388127754','1');
INSERT INTO jh_systmpl VALUES ('57','商城产品列表','seo','seo_mall_product','a:4:{s:10:\"cate_title\";s:12:\"分类名称\";s:14:\"cate_seo_title\";s:15:\"分类SEO标题\";s:17:\"cate_seo_keywords\";s:18:\"分类SEO关键字\";s:20:\"cate_seo_description\";s:15:\"分类SEO描述\";}','{cate_title}产品列表_{sitename}商城！','{cate_seo_title} 产品列表','{cate_seo_title} 产品列表','1388129502','1');
INSERT INTO jh_systmpl VALUES ('58','小区团装列表','seo','seo_home_tuan','a:2:{s:9:\"area_name\";s:6:\"地区\";s:4:\"page\";s:6:\"页码\";}','{city_name}团装小区_{sitename}','{city_name}团装小区{sitename}','{city_name}团装小区{sitename}','1388220204','1');
INSERT INTO jh_systmpl VALUES ('59','团装小区详情页','seo','seo_home_tuan_detail','a:4:{s:5:\"title\";s:6:\"标题\";s:9:\"tuan_desc\";s:6:\"描述\";s:9:\"home_name\";s:12:\"小区名称\";s:12:\"company_name\";s:12:\"公司名称\";}','{title}_团装小区_{sitename}','{title},团装小区','{title}_团装小区_{sitename}','1388223333','1');
INSERT INTO jh_systmpl VALUES ('60','业主:报名团装小区','sms','sms_home_tuan','a:4:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"home_name\";s:12:\"小区名称\";s:9:\"tuan_name\";s:12:\"团装名称\";}','尊敬的{contact}您于{dateline}预约了关于{tuan_name}的团装优惠！稍后网站客服将联系您！【{site_title}】','','','1388365708','1');
INSERT INTO jh_systmpl VALUES ('61','商家店铺','seo','seo_shop','a:6:{s:10:\"shop_title\";s:12:\"商铺标题\";s:9:\"shop_name\";s:12:\"商铺名称\";s:14:\"shop_seo_title\";s:15:\"商铺SEO标题\";s:17:\"shop_seo_keywords\";s:18:\"商铺SEO关键字\";s:20:\"shop_seo_description\";s:15:\"商铺SEO描述\";s:9:\"cate_name\";s:12:\"分类标题\";}','{shop_title}商家店铺-{sitename}','{shop_title}，装修商家店铺','{shop_title}_装修商家店铺-{sitename}','1388486923','1');
INSERT INTO jh_systmpl VALUES ('62','商品详情','seo','seo_product_detail','a:5:{s:5:\"title\";s:12:\"商品标题\";s:10:\"shop_title\";s:12:\"商铺标题\";s:9:\"shop_name\";s:12:\"商品名称\";s:10:\"cate_title\";s:12:\"分类标题\";s:12:\"product_desc\";s:12:\"商品描述\";}','{title}_{shop_title}店铺_{sitename}','{title}-{shop_title}-{sitename}','{title}-{shop_title}-{sitename}','1388487158','1');
INSERT INTO jh_systmpl VALUES ('63','优惠券首页','seo','seo_coupon','a:1:{s:4:\"page\";s:6:\"页码\";}','优惠券下载_{sitename}','装修优惠券下载，建材优惠券下载{sitename}','装修优惠券下载，建材优惠券下载{sitename}','1388488047','1');
INSERT INTO jh_systmpl VALUES ('64','优惠券详情','seo','seo_coupon_detail','a:7:{s:5:\"title\";s:15:\"优惠券标题\";s:10:\"shop_title\";s:12:\"店铺标题\";s:9:\"shop_name\";s:12:\"店铺名称\";s:14:\"shop_seo_title\";s:15:\"店铺SEO标题\";s:17:\"shop_seo_keywords\";s:18:\"店铺SEO关键字\";s:20:\"shop_seo_description\";s:15:\"店铺SEO描述\";s:11:\"coupon_desc\";s:15:\"优惠券描述\";}','{title}_优惠券下载_{shop_name}店铺','{title},{shop_seo_keywords}','{title},{shop_seo_description}','1388488144','1');
INSERT INTO jh_systmpl VALUES ('65','业主:下载优惠券','sms','sms_yezhu_coupon','a:9:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:6:\"number\";s:9:\"验证码\";s:6:\"coupon\";s:9:\"优惠券\";s:5:\"money\";s:12:\"优惠金额\";s:6:\"expire\";s:12:\"过期时间\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲，您领取了{shop_name}店铺优惠券（{coupon}）,编号:{number},有效期{expire_time}。【{site_title}】','','','1388582726','1');
INSERT INTO jh_systmpl VALUES ('66','商城商家列表','seo','seo_mall_store','a:5:{s:9:\"cate_name\";s:12:\"分类名称\";s:14:\"cate_seo_title\";s:15:\"分类SEO标题\";s:17:\"cate_seo_keywords\";s:18:\"分类SEO关键字\";s:20:\"cate_seo_description\";s:15:\"分类SEO描述\";s:4:\"page\";s:6:\"页码\";}','装修商家列表_{sitename}','{cate_seo_keywords}商家列表','{cate_seo_description}商家列表','1390297794','1');
INSERT INTO jh_systmpl VALUES ('67','装修工具','seo','seo_tools','a:1:{s:5:\"title\";s:12:\"工具名称\";}','装修计算器_装修工具箱_{site_title}','装修工具-{title}-{city_seo_keywords}','装修工具-{title}-{city_seo_description}','1392364664','1');
INSERT INTO jh_systmpl VALUES ('68','在建工地','seo','seo_site_items','a:2:{s:9:\"area_name\";s:6:\"地区\";s:4:\"page\";s:6:\"页码\";}','{city_name}装修在建工地_关注装修现场最新进展！','在建工地 - {city_seo_keywords}','在建工地 - {city_seo_description}','1392374902','1');
INSERT INTO jh_systmpl VALUES ('71','找工人列表','seo','seo_mechanic_items','a:3:{s:9:\"area_name\";s:6:\"地区\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','找装修工人_找施工队_{sitename}','','','1394945103','1');
INSERT INTO jh_systmpl VALUES ('72','找工人详情','seo','seo_mechanic_detail','a:2:{s:4:\"name\";s:6:\"姓名\";s:5:\"about\";s:6:\"介绍\";}','{name}_找装修工人_{sitename}','{site_title}{name}','{site_title}{name}','1394945160','1');
INSERT INTO jh_systmpl VALUES ('73','招标通知管理员邮件','mail','mail_admin_tenders','a:2:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";}','{site_title}-{contact}发布装修招标','<p>\r\n	亲爱的管理员 ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	有人发布了装修招标，请尽快与其联系。\r\n</p>\r\n<p>\r\n	<span style=\"line-height:1.5;\">联系人：{contact} &nbsp;手机号：{mobile}</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403322775','1');
INSERT INTO jh_systmpl VALUES ('74','安防智能公司预约通知','mail','mail_company_yuyue','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"company_name\";s:12:\"公司名称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司链接\";}','{site_title}-{contact}-安防智能公司预约通知','<p>\r\n	亲爱的 {company_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}预约了您的安防智能公司， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331686','1');
INSERT INTO jh_systmpl VALUES ('75','商铺预约通知','mail','mail_shop_yuyue','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','{site_title}-{contact}预约您的商铺','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}预约了您的商铺, 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331708','1');
INSERT INTO jh_systmpl VALUES ('76','优惠券下载通知','mail','mail_shop_coupon','a:7:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:6:\"手机\";s:6:\"coupon\";s:9:\"优惠券\";s:5:\"money\";s:15:\"优惠券金额\";s:6:\"expire\";s:12:\"过期时间\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title}-{contact}下载了优惠券','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}下载了您店铺的优惠券（{coupon}）, 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331737','1');
INSERT INTO jh_systmpl VALUES ('77','商品预约通知','mail','mail_product_yuyue','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"product_name\";s:12:\"商品名称\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','{site_title}-{contact}预约您的商品','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}预约了您的商品（{product_name}）, 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331767','1');
INSERT INTO jh_systmpl VALUES ('78','设计师预约通知','mail','mail_designer_yuyue','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"designer\";s:9:\"设计师\";}','{site_title}-{contact}预约您设计','<p>\r\n	亲爱的设计师 {designer} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}预约了您设计， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331836','1');
INSERT INTO jh_systmpl VALUES ('79','技工预约通知','mail','mail_mechanic_yuyue','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"mechanic\";s:6:\"技工\";}','{site_title}-{contact}预约了您','<p>\r\n	亲爱的技工 {mechanic} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}预约了您的服务， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331854','1');
INSERT INTO jh_systmpl VALUES ('80','订单创建成功','mail','mail_order_buyer','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title} - 订单创建（订单号{order_no}）','<p>\r\n	亲爱的 {contact} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	您的订单（订单号：{order_no}）已经生成，目前等待您的付款，我们将在收到款项之后立即安排发货。<a href=\"{order_link}\" target=\"_blank\">立即登录付款&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"{order_link}\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331887','1');
INSERT INTO jh_systmpl VALUES ('81','订单支付成功','mail','mail_order_payment_buyer','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title} -订单支付成功(订单号：{order_no})','<p>\r\n	亲爱的 {contact} ：\r\n</p>\r\n<p>\r\n	您的订单（订单号：{order_no}），已经支付成功<span>(金额：￥</span><span>{</span><span>order_amount})</span>，随后商家会安排发货。\r\n</p>\r\n<p>\r\n	商铺名称：{shop_name} &nbsp; 商家电话：{shop_phone}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">查看订单详情&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	----------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331906','1');
INSERT INTO jh_systmpl VALUES ('82','订单创建成功通知卖家','mail','mail_order_seller','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{shop_title}-有新的订单(订单号：{order_no})','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	您的商铺有新订单（订单号：{order_no}，目前等待买家的付款，您在收到款项之后请立即安排发货。<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">查看订单&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331922','1');
INSERT INTO jh_systmpl VALUES ('83','订单支付成功通知卖家','mail','mail_order_payment_seller','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title}-订单支付成功（{order_no}）','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	您商铺的订单（订单号：{order_no}），已经支付成功(金额：{order_amount})，请及时安排发货。\r\n</p>\r\n<p>\r\n	收件人：{contact} &nbsp; 手机：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">查看订单详情&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	----------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331957','1');
INSERT INTO jh_systmpl VALUES ('84','订单商品发货通知买家','mail','mail_order_ship_buyer','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title}-订单已发货（订单号：{order_no}）','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	您的商铺有新订单（订单号：{order_no}，卖家已经发货。\r\n</p>\r\n<p>\r\n	商铺名称：{shop_name} &nbsp; 商家电话：{shop_phone}\r\n</p>\r\n<p>\r\n	<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">查看订单&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331973','1');
INSERT INTO jh_systmpl VALUES ('85','订单确认收货通知卖家','mail','mail_order_ship_seller','a:6:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"收货人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";}','{site_title} -订单已经收货（订单号：{order_no}）','<p>\r\n	亲爱的 {shop_name} ：\r\n</p>\r\n<p>\r\n	您商铺的订单（订单号：{order_no}，买家已经确认收货。\r\n</p>\r\n<p>\r\n	收货人：{contact} &nbsp; 手机号：{shop_phone}\r\n</p>\r\n<p>\r\n	<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">查看订单&gt;&gt;</a> \r\n</p>\r\n<p>\r\n	无法访问可直接复制 ：<a href=\"http://www.hqcms.com/admin/%7Border_link%7D\" target=\"_blank\">{order_link}</a> \r\n</p>\r\n<p>\r\n	到浏览器窗口打开即可。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403331988','1');
INSERT INTO jh_systmpl VALUES ('86','后台管理分标通知','mail','mail_admin_tenders_company','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"company_name\";s:12:\"公司名称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','{site_title}-分给你个装修招标（{contact}）','<p>\r\n	亲爱的 {company_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span>管理员分配置给你了一个装修招标，预祝您签单成功！</span> \r\n</p>\r\n<p>\r\n	联系人：{contact} &nbsp;手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403332089','1');
INSERT INTO jh_systmpl VALUES ('87','网站活动报名','mail','mail_admin_activity','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"activity\";s:12:\"活动名称\";}','{site_title}-{contact}报名了网站活动','<p>\r\n	亲爱的管理员&nbsp;：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}报名了({activity})活动， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"http://www.jhcms.cn/admin/%7Bsite_url%7D\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403332157','1');
INSERT INTO jh_systmpl VALUES ('88','公司优惠信息报名','mail','mail_company_youhui','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:6:\"youhui\";s:12:\"优惠信息\";s:12:\"company_name\";s:12:\"公司名称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','{site_title}-{contact}报名优惠信息','<p>\r\n	亲爱的 {company_name} ：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}报名了您发布的优惠信息（{youhui}）， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403332182','1');
INSERT INTO jh_systmpl VALUES ('90','公司:预约查看工地','sms','sms_company_site','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:4:\"site\";s:6:\"工地\";s:12:\"company_name\";s:12:\"公司简称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','亲爱的{company_name},{contact}预约查看您的工地{site},手机号:{mobile}。【{site_title}】','','','1403342899','1');
INSERT INTO jh_systmpl VALUES ('91','店铺:下载优惠券','sms','sms_shop_coupon','a:8:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:6:\"coupon\";s:9:\"优惠券\";s:5:\"money\";s:12:\"优惠金额\";s:6:\"expire\";s:12:\"过期时间\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{shop_name},{contact}下载了您的店铺优惠券{coupon},手机号：{mobile}。【{site_title}】','','','1403345985','1');
INSERT INTO jh_systmpl VALUES ('92','业主:预约商家店铺','sms','sms_shop_yuyue','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{contact}，您于{dateline}预约了{shop_name},商家电话:{shop_phone},稍后商家会联系您！【{site_title}】','','','1403346290','1');
INSERT INTO jh_systmpl VALUES ('93','商铺:预约商家店铺','sms','sms_shop_tongzhi','a:5:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{shop_name}，{contact}预约了您的商家，手机号:{mobile}。【{site_title}】','','','1403346320','1');
INSERT INTO jh_systmpl VALUES ('94','业主:预约商铺商品','sms','sms_product_yuyue','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"product_name\";s:12:\"商品名称\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','尊敬的{contact}，您于{dateline}预约了{shop_name}的店铺的商品（{product_name}），商家电话:{shop_phone}。稍后商家会联系您！【{site_title}】','','','1403346374','1');
INSERT INTO jh_systmpl VALUES ('95','商铺:预约商铺商品','sms','sms_product_tongzhi','a:6:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:12:\"product_name\";s:12:\"商品名称\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{shop_name}，{contact}预约了您店铺的商品({product_name}),手机号：{mobile},预祝成功!【{site_title}】','','','1403346491','1');
INSERT INTO jh_systmpl VALUES ('96','业主:订单支付成功','sms','sms_order_payment_buyer','a:8:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:12:\"product_name\";s:12:\"商品名称\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{contact}，您的订单：{order_no}已经支付成功，支付金额：{order_amount} ，商家：{shop_name},商家电话:{shop_phone}。【{site_title}】','','','1403346711','1');
INSERT INTO jh_systmpl VALUES ('97','商铺:订单支持成功','sms','sms_order_payment_saller','a:8:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:12:\"product_name\";s:12:\"商品名称\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{shop_name},{contact}购买了你商品并支付成功，订单号：{order_no}，手机号：{mobile}，金额：{order_amount}。 【{site_title}】','','','1403346835','1');
INSERT INTO jh_systmpl VALUES ('98','公司:报名小区团装','sms','sms_home_tuan_company','a:7:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"tuan_name\";s:12:\"团装名称\";s:9:\"home_name\";s:12:\"小区名称\";s:12:\"company_name\";s:12:\"公司名称\";s:13:\"company_phone\";s:12:\"公司电话\";s:11:\"company_url\";s:12:\"公司主页\";}','亲爱的{company_name},{contact}报名了您的团装({tuan_name})，手机号：{mobile},祝您签单成功！ 【{site_title}】','','','1403496338','1');
INSERT INTO jh_systmpl VALUES ('99','小区团装报名通知','mail','mail_home_tuan','a:4:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"home_name\";s:12:\"小区名称\";s:9:\"tuan_name\";s:12:\"团购名称\";}','{site_title}-{contact}报名小区团装','<p>\r\n	亲爱的管理员&nbsp;：\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	{contact}报名了小区团装({tuan_name})， 手机号：{mobile}\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	-------------------------------------------------------------\r\n</p>\r\n<p>\r\n	感谢您使用<a href=\"{site_url}\" target=\"_blank\">{site_title}</a>！\r\n</p>','','1403496562','1');
INSERT INTO jh_systmpl VALUES ('100','会员:订单发货通知买家','sms','sms_order_ship_buyer','a:7:{s:8:\"order_no\";s:9:\"订单号\";s:12:\"order_amount\";s:12:\"订单金额\";s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:9:\"shop_name\";s:12:\"商铺名称\";s:10:\"shop_phone\";s:12:\"商铺电话\";s:8:\"shop_url\";s:12:\"商铺主页\";}','亲爱的{contact},您的订单（{order_no}）商家({shop_name})已经发货，金额：{order_amount}，商家电话:{shop_phone}。 【{site_title}】','','','1403503373','1');
INSERT INTO jh_systmpl VALUES ('101','业主:预约技工','sms','sms_mechanic_yuyue','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"mechanic\";s:6:\"技工\";}','亲爱的{contact}，您于{dateline}预约了技工（{mechanic}）,稍后会与您取得联系。 【{site_title}】','','','1403505468','1');
INSERT INTO jh_systmpl VALUES ('102','技工:预约技工','sms','sms_mechanic_tongzhi','a:3:{s:7:\"contact\";s:9:\"联系人\";s:6:\"mobile\";s:9:\"手机号\";s:8:\"mechanic\";s:6:\"技工\";}','亲爱的{mechanic},{contact}预约了您的服务，手机号：{mobile}。祝您签约成功 【{site_title}】','','','1403505507','1');
INSERT INTO jh_systmpl VALUES ('103','在建工地详情','seo','seo_site_detail','a:3:{s:5:\"title\";s:6:\"标题\";s:9:\"home_name\";s:12:\"小区名称\";s:12:\"company_name\";s:12:\"公司名称\";}','','','','1423220069','1');
INSERT INTO jh_systmpl VALUES ('104','在建式地地图','seo','seo_site_maps','a:0:{}','','','','1423220162','1');
INSERT INTO jh_systmpl VALUES ('105','找工长列表','seo','seo_gz_items','a:3:{s:9:\"area_name\";s:6:\"地区\";s:4:\"attr\";s:6:\"属性\";s:4:\"page\";s:6:\"页码\";}','','','','1233974953','1');
INSERT INTO jh_systmpl VALUES ('106','找式长详情','seo','seo_gz_detail','a:2:{s:4:\"name\";s:6:\"姓名\";s:5:\"about\";s:6:\"介绍\";}','','','','1233975010','1');
DROP TABLE IF EXISTS jh_tenders;
CREATE TABLE `jh_tenders` (
  `tenders_id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` enum('TZX','TBJ','TSJ','TJC','ZXB','TZB','TBJ','TWX','TLF') DEFAULT 'TZX',
  `zxb_id` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `area_id` mediumint(8) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `uid` mediumint(8) DEFAULT '0',
  `contact` varchar(32) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `home_id` mediumint(8) DEFAULT '0',
  `home_name` varchar(64) DEFAULT '',
  `way_id` smallint(6) DEFAULT '0',
  `type_id` smallint(5) DEFAULT '0',
  `style_id` smallint(5) DEFAULT '0',
  `fenxiaoid` mediumint(8) DEFAULT NULL,
  `budget_id` smallint(5) DEFAULT '0',
  `service_id` smallint(5) DEFAULT '0',
  `house_type_id` smallint(5) DEFAULT '0',
  `house_mj` mediumint(8) DEFAULT '0',
  `huxing` varchar(150) DEFAULT '',
  `addr` varchar(255) DEFAULT '',
  `comment` varchar(1024) DEFAULT '',
  `zx_time` int(10) DEFAULT '0',
  `tx_time` int(10) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `max_look` tinyint(3) DEFAULT '3',
  `looks` tinyint(3) DEFAULT '0',
  `views` mediumint(10) DEFAULT '0',
  `tracks` smallint(6) DEFAULT '0',
  `new_track` smallint(6) DEFAULT '0',
  `sign_uid` mediumint(8) DEFAULT '0',
  `sign_from` enum('company','gz','designer','mechanic','shop') DEFAULT 'company',
  `sign_company_id` mediumint(8) DEFAULT '0',
  `sign_info` varchar(1024) DEFAULT '',
  `sign_time` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(1024) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  `level` int(10) DEFAULT NULL,
  PRIMARY KEY (`tenders_id`),
  KEY `city_id` (`city_id`,`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=747 DEFAULT CHARSET=utf8 AUTO_INCREMENT=747;

INSERT INTO jh_tenders VALUES ('1','TLF','0','7','9','李女士的招标','0','李女士','13619611680','0','绿城翡翠湖玫瑰园','18','1','3','','8','9','16','136','','合肥绿城翡翠湖玫瑰园20幢602号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1417420580','');
INSERT INTO jh_tenders VALUES ('2','TBJ','0','7','5','郭女士的招标','0','郭女士','13955407718','0','北城世纪城','20','1','4','','6','10','13','121','','合肥北城世纪城20幢1306号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1417458589','');
INSERT INTO jh_tenders VALUES ('3','TSJ','0','7','12','赵先生的招标','0','赵先生','13724183033','0','中海·滨湖公馆','19','1','4','','7','10','14','155','','合肥中海·滨湖公馆20幢103号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1417527027','');
INSERT INTO jh_tenders VALUES ('4','TJC','0','7','8','郑女士的招标','0','郑女士','13364674407','0','融侨悦城','20','1','3','','6','10','12','134','','合肥融侨悦城15幢1103号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1417597143','');
INSERT INTO jh_tenders VALUES ('5','TLF','0','7','8','杨女士的招标','0','杨女士','13060822289','0','淮矿馥邦天下','19','1','3','','5','10','17','132','','合肥淮矿馥邦天下7幢202号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1417649593','');
INSERT INTO jh_tenders VALUES ('6','ZXB','0','7','12','王女士的招标','0','王女士','13169785688','0','万科蓝山','18','1','3','','7','10','13','146','','合肥万科蓝山8幢1306号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1417705490','');
INSERT INTO jh_tenders VALUES ('7','TLF','0','7','4','孙先生的招标','0','孙先生','13784337740','0','淮矿馥邦天下','18','1','4','','7','10','15','71','','合肥淮矿馥邦天下9幢301号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1417749366','');
INSERT INTO jh_tenders VALUES ('8','TZX','0','7','13','何女士的招标','0','何女士','13096372096','0','禹洲天境','18','1','4','','6','10','17','103','','合肥禹洲天境8幢604号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1417792842','');
INSERT INTO jh_tenders VALUES ('9','TSJ','0','7','12','郑先生的招标','0','郑先生','13444712019','0','万科森林公园','18','1','4','','7','10','14','149','','合肥万科森林公园15幢2004号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1417843106','');
INSERT INTO jh_tenders VALUES ('10','ZXB','0','7','13','蒋先生的招标','0','蒋先生','13196391973','0','万科蓝山','19','1','4','','7','10','12','81','','合肥万科蓝山2幢201号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1417886683','');
INSERT INTO jh_tenders VALUES ('11','ZXB','0','7','6','郑女士的招标','0','郑女士','13660089960','0','绿城翡翠湖玫瑰园','20','1','3','','6','10','15','118','','合肥绿城翡翠湖玫瑰园2幢601号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1417947860','');
INSERT INTO jh_tenders VALUES ('12','TLF','0','7','13','钱先生的招标','0','钱先生','13850609718','0','禹洲中央广场','19','1','3','','6','9','16','87','','合肥禹洲中央广场8幢604号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1418018905','');
INSERT INTO jh_tenders VALUES ('13','TJC','0','7','14','吴女士的招标','0','吴女士','13292287011','0','禹洲中央广场','20','1','3','','6','9','14','154','','合肥禹洲中央广场2幢2104号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1418062123','');
INSERT INTO jh_tenders VALUES ('14','TSJ','0','7','3','孙先生的招标','0','孙先生','13337435886','0','保利香槟国际','19','1','3','','6','9','11','96','','合肥保利香槟国际19幢1502号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1418099644','');
INSERT INTO jh_tenders VALUES ('15','ZXB','0','7','9','李先生的招标','0','李先生','13817681896','0','佳源巴黎都市','20','1','4','','7','10','12','138','','合肥佳源巴黎都市1幢806号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1418165807','');
INSERT INTO jh_tenders VALUES ('16','TJC','0','7','12','王先生的招标','0','王先生','13885225437','0','万科蓝山','20','1','3','','8','10','14','108','','合肥万科蓝山15幢403号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1418213186','');
INSERT INTO jh_tenders VALUES ('17','ZXB','0','7','14','王女士的招标','0','王女士','13452167559','0','华润熙云府','20','1','3','','8','10','13','87','','合肥华润熙云府2幢1205号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1418254431','');
INSERT INTO jh_tenders VALUES ('18','TBJ','0','7','14','刘先生的招标','0','刘先生','13429046532','0','绿城翡翠湖玫瑰园','20','1','4','','5','10','15','153','','合肥绿城翡翠湖玫瑰园18幢303号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1418298164','');
INSERT INTO jh_tenders VALUES ('19','ZXB','0','7','8','施女士的招标','0','施女士','13871533583','0','华润熙云府','19','1','4','','8','10','16','144','','合肥华润熙云府8幢602号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1418338515','');
INSERT INTO jh_tenders VALUES ('20','TJC','0','7','8','施女士的招标','0','施女士','13089024156','0','中海·滨湖公馆','19','1','3','','8','10','14','89','','合肥中海·滨湖公馆11幢202号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1418389893','');
INSERT INTO jh_tenders VALUES ('21','TBJ','0','7','13','吴先生的招标','0','吴先生','13374440402','0','禹洲中央广场','20','1','3','','5','9','15','67','','合肥禹洲中央广场15幢904号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1418451709','');
INSERT INTO jh_tenders VALUES ('22','TLF','0','7','13','蒋女士的招标','0','蒋女士','13760451302','0','保利香槟国际','19','1','4','','5','10','15','70','','合肥保利香槟国际19幢2104号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1418520231','');
INSERT INTO jh_tenders VALUES ('23','TZX','0','7','7','施先生的招标','0','施先生','13390273442','0','禹洲中央广场','20','1','4','','8','10','14','98','','合肥禹洲中央广场18幢1005号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1418561011','');
INSERT INTO jh_tenders VALUES ('24','ZXB','0','7','10','何女士的招标','0','何女士','13247804789','0','禹洲天境','18','1','4','','6','10','12','147','','合肥禹洲天境16幢2101号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1418606144','');
INSERT INTO jh_tenders VALUES ('25','TSJ','0','7','14','郭女士的招标','0','郭女士','13878234509','0','绿城翡翠湖玫瑰园','19','1','4','','7','9','12','96','','合肥绿城翡翠湖玫瑰园10幢1901号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1418648590','');
INSERT INTO jh_tenders VALUES ('26','TBJ','0','7','14','戴先生的招标','0','戴先生','13495932913','0','合肥万达文化旅游城','20','1','3','','5','9','17','67','','合肥合肥万达文化旅游城16幢504号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1418696603','');
INSERT INTO jh_tenders VALUES ('27','ZXB','0','7','4','李女士的招标','0','李女士','13059326624','0','北城世纪城','20','1','4','','8','9','14','112','','合肥北城世纪城10幢805号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1418745467','');
INSERT INTO jh_tenders VALUES ('28','TSJ','0','7','5','郑先生的招标','0','郑先生','13314493054','0','淮矿馥邦天下','18','1','4','','7','9','11','125','','合肥淮矿馥邦天下11幢1204号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1418781955','');
INSERT INTO jh_tenders VALUES ('29','TLF','0','7','8','王先生的招标','0','王先生','13589763864','0','合肥万达文化旅游城','18','1','4','','5','10','17','136','','合肥合肥万达文化旅游城18幢1903号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1418847882','');
INSERT INTO jh_tenders VALUES ('30','TZX','0','7','12','郑先生的招标','0','郑先生','13888461731','0','淮矿东方蓝海','19','1','3','','8','9','11','70','','合肥淮矿东方蓝海3幢304号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1418918468','');
INSERT INTO jh_tenders VALUES ('31','ZXB','0','7','4','鲁先生的招标','0','鲁先生','13522546878','0','高速中央广场','18','1','3','','8','10','17','66','','合肥高速中央广场1幢604号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1418966397','');
INSERT INTO jh_tenders VALUES ('32','TJC','0','7','10','戴女士的招标','0','戴女士','13766400584','0','淮矿馥邦天下','18','1','4','','8','10','15','126','','合肥淮矿馥邦天下7幢1602号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1419004696','');
INSERT INTO jh_tenders VALUES ('33','TZX','0','7','14','赵女士的招标','0','赵女士','13593224156','0','中海·滨湖公馆','20','1','3','','8','10','12','100','','合肥中海·滨湖公馆10幢306号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419053546','');
INSERT INTO jh_tenders VALUES ('34','TJC','0','7','13','郭女士的招标','0','郭女士','13682852085','0','禹洲翡翠湖郡','19','1','3','','7','10','14','114','','合肥禹洲翡翠湖郡1幢106号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419097338','');
INSERT INTO jh_tenders VALUES ('35','TBJ','0','7','5','孙先生的招标','0','孙先生','13795296255','0','万科蓝山','18','1','3','','5','10','15','153','','合肥万科蓝山16幢1201号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1419139039','');
INSERT INTO jh_tenders VALUES ('36','ZXB','0','7','6','王女士的招标','0','王女士','13860783786','0','滨湖万科城','18','1','4','','6','9','11','84','','合肥滨湖万科城9幢701号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1419196570','');
INSERT INTO jh_tenders VALUES ('37','TJC','0','7','4','郭先生的招标','0','郭先生','13797047036','0','万科金域华府','20','1','3','','7','9','13','89','','合肥万科金域华府3幢1603号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1419259876','');
INSERT INTO jh_tenders VALUES ('38','TBJ','0','7','10','戴先生的招标','0','戴先生','13584923514','0','淮矿馥邦天下','18','1','3','','8','10','12','75','','合肥淮矿馥邦天下7幢902号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1419297613','');
INSERT INTO jh_tenders VALUES ('39','TLF','0','7','14','刘先生的招标','0','刘先生','13833583397','0','绿城翡翠湖玫瑰园','18','1','4','','6','9','12','125','','合肥绿城翡翠湖玫瑰园14幢603号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1419357543','');
INSERT INTO jh_tenders VALUES ('40','TJC','0','7','3','吴先生的招标','0','吴先生','13275715052','0','绿城翡翠湖玫瑰园','20','1','3','','6','10','15','125','','合肥绿城翡翠湖玫瑰园9幢1803号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1419425914','');
INSERT INTO jh_tenders VALUES ('41','TSJ','0','7','10','赵女士的招标','0','赵女士','13734258524','0','禹洲中央广场','18','1','3','','5','9','14','87','','合肥禹洲中央广场12幢1403号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419466217','');
INSERT INTO jh_tenders VALUES ('42','TJC','0','7','12','钱女士的招标','0','钱女士','13737117211','0','滨湖万科城','18','1','4','','6','9','12','85','','合肥滨湖万科城9幢702号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419518610','');
INSERT INTO jh_tenders VALUES ('43','TBJ','0','7','8','单先生的招标','0','单先生','13181078759','0','绿城翡翠湖玫瑰园','19','1','4','','5','9','13','104','','合肥绿城翡翠湖玫瑰园19幢2002号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419577505','');
INSERT INTO jh_tenders VALUES ('44','ZXB','0','7','13','何女士的招标','0','何女士','13740335410','0','融侨悦城','18','1','3','','8','9','12','124','','合肥融侨悦城6幢2103号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1419645993','');
INSERT INTO jh_tenders VALUES ('45','ZXB','0','7','7','李先生的招标','0','李先生','13134946548','0','禹洲中央广场','19','1','4','','8','10','11','136','','合肥禹洲中央广场14幢1106号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1419693065','');
INSERT INTO jh_tenders VALUES ('46','ZXB','0','7','7','赵女士的招标','0','赵女士','13042410685','0','万科金域华府','19','1','3','','8','9','12','108','','合肥万科金域华府11幢1906号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1419756030','');
INSERT INTO jh_tenders VALUES ('47','TJC','0','7','5','周女士的招标','0','周女士','13239707026','0','淮矿馥邦天下','18','1','3','','6','9','14','69','','合肥淮矿馥邦天下18幢606号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419822669','');
INSERT INTO jh_tenders VALUES ('48','TLF','0','7','3','郭先生的招标','0','郭先生','13097604770','0','禹洲翡翠湖郡','18','1','3','','5','10','12','78','','合肥禹洲翡翠湖郡20幢1502号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1419889305','');
INSERT INTO jh_tenders VALUES ('49','TSJ','0','7','12','郑先生的招标','0','郑先生','13388436568','0','万科金域华府','20','1','4','','7','10','15','151','','合肥万科金域华府3幢1603号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1419957828','');
INSERT INTO jh_tenders VALUES ('50','ZXB','0','7','3','刘先生的招标','0','刘先生','13222929312','0','合肥万达文化旅游城','20','1','3','','5','10','16','112','','合肥合肥万达文化旅游城20幢404号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1420028402','');
INSERT INTO jh_tenders VALUES ('51','TJC','0','7','13','何先生的招标','0','何先生','13658275820','0','禹洲翡翠湖郡','19','1','3','','6','10','17','104','','合肥禹洲翡翠湖郡6幢1303号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1420079140','');
INSERT INTO jh_tenders VALUES ('52','TBJ','0','7','10','孙女士的招标','0','孙女士','13635110364','0','滨湖万科城','19','1','4','','7','10','16','107','','合肥滨湖万科城17幢1703号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1420137801','');
INSERT INTO jh_tenders VALUES ('53','TJC','0','7','6','施先生的招标','0','施先生','13043864388','0','淮矿馥邦天下','20','1','4','','6','9','17','112','','合肥淮矿馥邦天下11幢105号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1420178104','');
INSERT INTO jh_tenders VALUES ('54','TJC','0','7','13','李女士的招标','0','李女士','13272907512','0','淮矿东方蓝海','18','1','3','','8','10','14','138','','合肥淮矿东方蓝海3幢1203号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1420232170','');
INSERT INTO jh_tenders VALUES ('55','TJC','0','7','7','蒋女士的招标','0','蒋女士','13180931373','0','绿城翡翠湖玫瑰园','20','1','4','','7','10','16','127','','合肥绿城翡翠湖玫瑰园13幢104号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1420274467','');
INSERT INTO jh_tenders VALUES ('56','TLF','0','7','8','郑先生的招标','0','郑先生','13848589225','0','华润熙云府','19','1','3','','7','10','13','88','','合肥华润熙云府18幢1603号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1420340766','');
INSERT INTO jh_tenders VALUES ('57','TSJ','0','7','13','吴先生的招标','0','吴先生','13376652494','0','中海·滨湖公馆','18','1','4','','8','9','16','102','','合肥中海·滨湖公馆4幢1702号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1420397440','');
INSERT INTO jh_tenders VALUES ('58','TJC','0','7','12','单女士的招标','0','单女士','13144431195','0','万科金域华府','19','1','3','','6','9','13','154','','合肥万科金域华府10幢806号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1420443558','');
INSERT INTO jh_tenders VALUES ('59','TLF','0','7','7','赵先生的招标','0','赵先生','13334049871','0','万科森林公园','19','1','4','','8','9','14','83','','合肥万科森林公园1幢1905号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1420495127','');
INSERT INTO jh_tenders VALUES ('60','TJC','0','7','13','杨女士的招标','0','杨女士','13829865495','0','华润熙云府','18','1','4','','8','9','11','69','','合肥华润熙云府20幢403号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1420565487','');
INSERT INTO jh_tenders VALUES ('61','TJC','0','7','5','钱先生的招标','0','钱先生','13590971917','0','高速中央广场','18','1','4','','5','10','11','104','','合肥高速中央广场10幢405号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1420612918','');
INSERT INTO jh_tenders VALUES ('62','TJC','0','7','7','钱先生的招标','0','钱先生','13647682933','0','华润熙云府','20','1','4','','6','9','15','134','','合肥华润熙云府2幢804号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1420672387','');
INSERT INTO jh_tenders VALUES ('63','TZX','0','7','6','钱女士的招标','0','钱女士','13494932930','0','华润熙云府','18','1','3','','8','10','16','77','','合肥华润熙云府1幢903号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1420736903','');
INSERT INTO jh_tenders VALUES ('64','TBJ','0','7','8','鲁女士的招标','0','鲁女士','13560272463','0','高速中央广场','18','1','3','','8','9','15','105','','合肥高速中央广场19幢2002号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1420774538','');
INSERT INTO jh_tenders VALUES ('65','TZX','0','7','3','鲁先生的招标','0','鲁先生','13778001041','0','华润熙云府','18','1','4','','5','10','12','95','','合肥华润熙云府17幢201号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1420842155','');
INSERT INTO jh_tenders VALUES ('66','TLF','0','7','12','何女士的招标','0','何女士','13755583887','0','佳源巴黎都市','20','1','3','','8','9','15','103','','合肥佳源巴黎都市7幢1806号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1420894813','');
INSERT INTO jh_tenders VALUES ('67','TBJ','0','7','3','刘女士的招标','0','刘女士','13669863530','0','长虹世纪荣廷','19','1','4','','7','10','11','132','','合肥长虹世纪荣廷11幢703号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1420946850','');
INSERT INTO jh_tenders VALUES ('68','TZX','0','7','6','周先生的招标','0','周先生','13036451360','0','淮矿东方蓝海','19','1','4','','6','9','11','155','','合肥淮矿东方蓝海17幢302号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1420998717','');
INSERT INTO jh_tenders VALUES ('69','TBJ','0','7','7','鲁先生的招标','0','鲁先生','13226307644','0','高速中央广场','20','1','4','','8','9','15','127','','合肥高速中央广场12幢1603号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1421060702','');
INSERT INTO jh_tenders VALUES ('70','TLF','0','7','14','周先生的招标','0','周先生','13139737522','0','淮矿东方蓝海','18','1','3','','7','10','17','88','','合肥淮矿东方蓝海1幢1203号','','0','0','40','3','0','0','0','0','0','company','0','','0','0','','1','','1421126169','');
INSERT INTO jh_tenders VALUES ('71','TLF','0','7','3','杨女士的招标','0','杨女士','13863822979','0','禹洲翡翠湖郡','19','1','4','','5','9','16','114','','合肥禹洲翡翠湖郡12幢606号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1421190084','');
INSERT INTO jh_tenders VALUES ('72','TJC','0','7','12','戴女士的招标','0','戴女士','13452791544','0','万科森林公园','19','1','3','','6','9','11','114','','合肥万科森林公园14幢1304号','','0','0','60','3','0','0','0','0','0','company','0','','0','0','','1','','1421235610','');
INSERT INTO jh_tenders VALUES ('73','TJC','0','7','4','钱先生的招标','0','钱先生','13546996815','0','禹洲天境','20','1','3','','8','10','13','119','','合肥禹洲天境20幢104号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1421298128','');
INSERT INTO jh_tenders VALUES ('74','TBJ','0','7','4','王女士的招标','0','王女士','13261304955','0','合肥万达文化旅游城','18','1','4','','6','9','15','154','','合肥合肥万达文化旅游城8幢1401号','','0','0','30','3','0','0','0','0','0','company','0','','0','0','','1','','1421365166','');
INSERT INTO jh_tenders VALUES ('75','TBJ','0','7','8','周女士的招标','0','周女士','13714805433','0','绿城翡翠湖玫瑰园','18','1','3','','7','10','11','134','','合肥绿城翡翠湖玫瑰园20幢2203号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1421419542','');
INSERT INTO jh_tenders VALUES ('76','ZXB','0','7','13','刘先生的招标','0','刘先生','13653012058','0','禹洲翡翠湖郡','18','1','4','','6','10','15','94','','合肥禹洲翡翠湖郡8幢1403号','','0','0','10','3','0','0','0','0','0','company','0','','0','0','','1','','1421491376','');
INSERT INTO jh_tenders VALUES ('77','TSJ','0','7','7','刘女士的招标','0','刘女士','13747374073','0','滨湖万科城','18','1','3','','8','10','11','156','','合肥滨湖万科城4幢1303号','','0','0','50','3','0','0','0','0','0','company','0','','0','0','','1','','1421538828','');
INSERT INTO jh_tenders VALUES ('78','TZX','0','7','7','刘先生的招标','0','刘先生','13396112883','0','禹洲天玺','19','1','3','','7','10','12','154','','合肥禹洲天玺18幢1706号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1421600902','');
INSERT INTO jh_tenders VALUES ('79','TJC','0','7','13','孙先生的招标','0','孙先生','13951974003','0','禹洲天境','18','1','3','','7','9','11','121','','合肥禹洲天境18幢1105号','','0','0','20','3','0','0','0','0','0','company','0','','0','0','','1','','1421670014','');
DROP TABLE IF EXISTS jh_tenders_attr;
CREATE TABLE `jh_tenders_attr` (
  `tenders_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attr_id` smallint(6) unsigned DEFAULT '0',
  `attr_value_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tenders_id`,`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_tenders_log;
CREATE TABLE `jh_tenders_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenders_id` mediumint(8) DEFAULT '0',
  `tx_time` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `remark` mediumtext,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_tenders_look;
CREATE TABLE `jh_tenders_look` (
  `look_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenders_id` mediumint(8) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `from` enum('company','gz','designer','mechanic','shop') DEFAULT 'company',
  `company_id` mediumint(8) DEFAULT '0',
  `info` varchar(1024) DEFAULT '',
  `is_signed` tinyint(1) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`look_id`),
  UNIQUE KEY `tenders_id` (`tenders_id`,`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 AUTO_INCREMENT=131;

DROP TABLE IF EXISTS jh_tenders_setting;
CREATE TABLE `jh_tenders_setting` (
  `setting_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 AUTO_INCREMENT=23;

INSERT INTO jh_tenders_setting VALUES ('1','1','家装','50');
INSERT INTO jh_tenders_setting VALUES ('2','1','公装','50');
INSERT INTO jh_tenders_setting VALUES ('3','2','欧美','50');
INSERT INTO jh_tenders_setting VALUES ('4','2','日韩','50');
INSERT INTO jh_tenders_setting VALUES ('5','3','3万以下','50');
INSERT INTO jh_tenders_setting VALUES ('6','3','3万-5万','50');
INSERT INTO jh_tenders_setting VALUES ('7','3','5-8万','50');
INSERT INTO jh_tenders_setting VALUES ('8','3','8万以上','50');
INSERT INTO jh_tenders_setting VALUES ('9','4','免费设计','50');
INSERT INTO jh_tenders_setting VALUES ('10','4','免费量房','50');
INSERT INTO jh_tenders_setting VALUES ('11','5','一室一厅','50');
INSERT INTO jh_tenders_setting VALUES ('12','5','二室一厅','50');
INSERT INTO jh_tenders_setting VALUES ('13','5','二室二厅','50');
INSERT INTO jh_tenders_setting VALUES ('14','5','三室一厅','50');
INSERT INTO jh_tenders_setting VALUES ('15','5','三室两厅','50');
INSERT INTO jh_tenders_setting VALUES ('16','5','四室两厅','50');
INSERT INTO jh_tenders_setting VALUES ('17','5','四室以上','50');
INSERT INTO jh_tenders_setting VALUES ('18','6','清包','50');
INSERT INTO jh_tenders_setting VALUES ('19','6','半包','50');
INSERT INTO jh_tenders_setting VALUES ('20','6','全包','50');
DROP TABLE IF EXISTS jh_tenders_track;
CREATE TABLE `jh_tenders_track` (
  `track_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `look_id` mediumint(8) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `replyip` varchar(15) DEFAULT '',
  `replytime` int(10) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`track_id`),
  KEY `look_id` (`look_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 AUTO_INCREMENT=35;

DROP TABLE IF EXISTS jh_themes;
CREATE TABLE `jh_themes` (
  `theme_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT '',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(150) DEFAULT '',
  `config` mediumtext,
  `default` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`theme_id`),
  KEY `theme` (`theme`,`default`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 AUTO_INCREMENT=74;

INSERT INTO jh_themes VALUES ('1','default','默认模板','thumb.jpg','','0','0');
DROP TABLE IF EXISTS jh_themes_bak;
CREATE TABLE `jh_themes_bak` (
  `bak_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(30) DEFAULT '',
  `tmpl` varchar(150) DEFAULT '',
  `content` mediumtext,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`bak_id`)
) ENGINE=MyISAM AUTO_INCREMENT=192 DEFAULT CHARSET=utf8 AUTO_INCREMENT=192;

DROP TABLE IF EXISTS jh_topics;
CREATE TABLE `jh_topics` (
  `topics_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `card` char(50) DEFAULT '0',
  `education` smallint(3) unsigned DEFAULT NULL,
  `marriage` smallint(3) unsigned DEFAULT NULL,
  `city_id` mediumint(8) DEFAULT NULL,
  `area_id` mediumint(8) DEFAULT NULL,
  `addr` mediumtext,
  `work` varchar(100) DEFAULT NULL,
  `c_addr` mediumtext,
  `c_mobile` varchar(20) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `home_person` varchar(100) DEFAULT NULL,
  `home_relationship` smallint(3) DEFAULT NULL,
  `home_phone` char(20) DEFAULT NULL,
  `orter_person` varchar(100) DEFAULT NULL,
  `orter_relationship` smallint(3) DEFAULT '0',
  `orter_phone` varchar(20) DEFAULT NULL,
  `photo1` varchar(200) DEFAULT NULL,
  `photo2` varchar(200) DEFAULT NULL,
  `photo3` varchar(200) DEFAULT NULL,
  `bank` smallint(3) DEFAULT NULL,
  `bank_card` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  `money` mediumint(8) DEFAULT NULL,
  `zq` smallint(3) DEFAULT NULL,
  PRIMARY KEY (`topics_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

DROP TABLE IF EXISTS jh_truste;
CREATE TABLE `jh_truste` (
  `truste_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cate_id` mediumint(8) NOT NULL,
  `budget` mediumint(8) NOT NULL,
  `truste` mediumint(8) NOT NULL,
  `is_pay` tinyint(1) DEFAULT '0',
  `uid` mediumint(8) NOT NULL,
  `city_id` mediumint(8) DEFAULT NULL,
  `area_id` mediumint(8) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `looks` smallint(5) DEFAULT '0',
  `max_look` smallint(5) DEFAULT NULL,
  `sign_from` enum('company','gz','designer','mechanic','shop') DEFAULT NULL,
  `sign_uid` mediumint(8) DEFAULT '0',
  `sign_info` varchar(500) DEFAULT NULL,
  `sign_time` int(10) DEFAULT NULL,
  `sign_company_id` mediumint(8) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `views` mediumint(8) DEFAULT '0',
  `gold` smallint(6) DEFAULT '0',
  `photo` varchar(200) DEFAULT NULL,
  `addr` varchar(500) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `status` smallint(3) DEFAULT '0',
  `title` varchar(200) DEFAULT NULL,
  `comment_id` mediumint(8) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`truste_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 AUTO_INCREMENT=38;

DROP TABLE IF EXISTS jh_truste_cate;
CREATE TABLE `jh_truste_cate` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `parent_id` mediumint(8) DEFAULT '0',
  `seo_title` varchar(150) DEFAULT '',
  `seo_keywords` varchar(255) DEFAULT '',
  `seo_description` varchar(200) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=367 DEFAULT CHARSET=utf8 AUTO_INCREMENT=367;

DROP TABLE IF EXISTS jh_truste_look;
CREATE TABLE `jh_truste_look` (
  `look_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `truste_id` mediumint(8) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `from` enum('company','gz','designer','mechanic','shop') DEFAULT 'company',
  `company_id` mediumint(8) DEFAULT '0',
  `info` varchar(1024) DEFAULT '',
  `is_signed` tinyint(1) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`look_id`),
  UNIQUE KEY `tenders_id` (`truste_id`,`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 AUTO_INCREMENT=127;

DROP TABLE IF EXISTS jh_upload_photo;
CREATE TABLE `jh_upload_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(30) DEFAULT '',
  `hash` char(32) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `size` smallint(6) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM AUTO_INCREMENT=1399 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1399;

INSERT INTO jh_upload_photo VALUES ('1','adv','fe2749606549a7a0ee518c1b5ab0547e','20141223_9014F0E9B9B45A8ECF0EE03CB105AFFD.jpg','demo/photo/201502/20150214_B6DB685A15B0D23B2848313B75B648C0.jpg','32767','1423898464');
INSERT INTO jh_upload_photo VALUES ('2','adv','b1e6021f01f37b5bb30c6abb28fd0b99','288_5903.jpg','demo/photo/201502/20150214_ECC1D24CCF774C7C40FB24270B5F5DA9.jpg','32767','1423898723');
INSERT INTO jh_upload_photo VALUES ('3','adv','38ab454610173888893fcd0c668ecc1d','20141224_DB147537498DBF2EFA8793C100C7C080.jpg','demo/photo/201502/20150214_FA9F38AF185E21179697C32B252FF979.jpg','32767','1423902624');
INSERT INTO jh_upload_photo VALUES ('4','adv','87746edf234dd6e3c86f7ffc808a8394','20141224_7BD011B3D775BAE96C2486A2DB6C5C2F.jpg','demo/photo/201502/20150214_C29C84365B7D33B4A364ABF908D33B83.jpg','32767','1423902720');
INSERT INTO jh_upload_photo VALUES ('5','adv','85dd57603d18e4910b55f4422c148eb6','mf700-03178392.jpg','demo/photo/201502/20150214_C51A459593F516B91DB752DBDA83C3D1.jpg','32767','1423904094');
INSERT INTO jh_upload_photo VALUES ('6','adv','88745e388f18df0fe55ab97c4fab2326','37501474_h.jpg','demo/photo/201502/20150214_77CC11F04363A0143B3A206C279B5EE2.jpg','32767','1423904098');
INSERT INTO jh_upload_photo VALUES ('7','adv','c8e2a92d6cb59d42c10a5baa41c4d605','37501474_h.jpg','demo/photo/201502/20150214_49C58AC6D2C6A794CFB8C3EE22E96F87.jpg','32767','1423905292');
INSERT INTO jh_upload_photo VALUES ('8','adv','492f9e4ac721625e428ab12b85002dfe','mf700-03178392.jpg','demo/photo/201502/20150214_A6D479E180260CB413D352911EE0E12D.jpg','32767','1423905299');
INSERT INTO jh_upload_photo VALUES ('9','adv','d733792467d24c0ab1e81bde72c2b3de','is836-057.jpg','demo/photo/201502/20150214_B45CE5B14644929082E64A0948CF38AC.jpg','30974','1423905502');
INSERT INTO jh_upload_photo VALUES ('10','adv','5e99b1a6b930b989320de9a24b20a9a5','ima78026.jpg','demo/photo/201502/20150214_07B11E463522D35DBACFDCD5BD2D2F09.jpg','32767','1423905988');
INSERT INTO jh_upload_photo VALUES ('11','home','500e42ac18bf6fec02428571425d5363','20141227_d5077e7d0d283406a2d95do3692q96vl_230x230M.jpg','demo/photo/201502/20150215_4CE8F3283BEDF30F3813FB9AEF9DA850.jpg','27072','1423966458');
INSERT INTO jh_upload_photo VALUES ('12','','c02e5f795f4b9969ad86a79c3e24650b','20141227_510c5d59e7c226961311qrjok097s07n.jpg','demo/photo/201502/20150215_4B6B85BB2EEB4070832B866BB727791B.jpg','32767','1423966621');
INSERT INTO jh_upload_photo VALUES ('13','','0128a16b2e359e58fcd2cd643d99e87e','20141227_198947c6fb4481fbd943cx32ey6t0zc9.jpg','demo/photo/201502/20150215_146BB0353E726883B5D8413496F575B3.jpg','32767','1423966622');
INSERT INTO jh_upload_photo VALUES ('14','','fc1bb6b7f49ba25f546b53e5dbe622c5','20141227_f2b80c86ba1c14ec7188yjn86gemotce.jpg','demo/photo/201502/20150215_D5A43567A1737B00822424FCFE8227D3.jpg','32767','1423966622');
INSERT INTO jh_upload_photo VALUES ('15','','daebd6d839bd5f13d799739ea99cfca9','20141227_510c5d59e7c226961311qrjok097s07n.jpg','demo/photo/201502/20150215_F3C5B35AB50849473D370CAE18BD68CA.jpg','32767','1423967231');
INSERT INTO jh_upload_photo VALUES ('16','','6398e0c8887b8f42db450e7255a7b830','20141227_198947c6fb4481fbd943cx32ey6t0zc9.jpg','demo/photo/201502/20150215_76352C6E5DCEC506EAD5F932321A0AAA.jpg','32767','1423967232');
INSERT INTO jh_upload_photo VALUES ('17','','ca5584459a3cdd375f9e8ca7d9ee97b1','20141227_f2b80c86ba1c14ec7188yjn86gemotce.jpg','demo/photo/201502/20150215_8E62307B36DE756822CD6C0DBC26851D.jpg','32767','1423967232');
INSERT INTO jh_upload_photo VALUES ('18','','11f62bdd7796aa14d14665ad98c0d789','20141227_37e076a2ef114cf7ba83k57s8zr4gzsw.jpg','demo/photo/201502/20150215_2BF0FAD163E891D8D2BC513DF4E1D20F.jpg','32767','1423967292');
INSERT INTO jh_upload_photo VALUES ('19','','adf301d8b897fc8fe0e98ec42848b312','20141227_b9a9a54494d5df9d217appa90e6gyfl5.jpg','demo/photo/201502/20150215_6E936C4BBDFC52E089B9F93F529D6EF2.jpg','32767','1423967292');
INSERT INTO jh_upload_photo VALUES ('20','','4444f712e0168e8ce3727c331247dfde','20141227_d8f712f4955b0c572acas4l75rj8duke.jpg','demo/photo/201502/20150215_0F2D5CABD7C83B04844F1D2BB6A9C462.jpg','32767','1423967293');
INSERT INTO jh_upload_photo VALUES ('21','','6f3027d3167532c04812a6994dcca87e','20141227_d5077e7d0d283406a2d95do3692q96vl.jpg','demo/photo/201502/20150215_5836E19E67627CB5612AB578718CE73C.jpg','32767','1423967293');
INSERT INTO jh_upload_photo VALUES ('22','home','a15395004219d162b25716207a7942db','20150108_0a934155f138a5a667b04vrtdvvkk7o3_230x230M.jpg','demo/photo/201502/20150215_7730E106F3B6569D2B90E9CCA9F9B0FE.jpg','23339','1423967516');
INSERT INTO jh_upload_photo VALUES ('23','','eebd2dc09fb51508895241c51a0c8aef','20150108_0a934155f138a5a667b04vrtdvvkk7o3.jpg','demo/photo/201502/20150215_79C9112EBF9DEE700C83760C86C639D0.jpg','32767','1423967990');
INSERT INTO jh_upload_photo VALUES ('24','','801dec5a32757eb3ad189d5fceba4a2e','20150108_105ac84083058bc952b8inxncjx9cev7.jpg','demo/photo/201502/20150215_CDA38E2C0D8954CDF558C2ECB7BAA44B.jpg','32767','1423967991');
INSERT INTO jh_upload_photo VALUES ('25','','591f33045261222c3ab697fc4ad6022f','20150108_3571c892546b6526cc4fts7rr26atc3m.jpg','demo/photo/201502/20150215_438FF0D6CAB63B773A28C7627189C10F.jpg','32767','1423967991');
INSERT INTO jh_upload_photo VALUES ('26','','8dddd565147f8a9b33dcb88c32e429a5','20150108_bbca0e7f4bb5afc2d23cmoez53dpx5em.jpg','demo/photo/201502/20150215_9BCC308E2BCDF78DDFA2B8B37A3AF913.jpg','32767','1423967992');
INSERT INTO jh_upload_photo VALUES ('27','','999c2d632869e72a46d53ecbe51e2ba7','20150108_c6426208b225f1fe15ef1tin2uafsfzg.jpg','demo/photo/201502/20150215_FF32F3089725FA760B9448200539D6B6.jpg','32767','1423967992');
INSERT INTO jh_upload_photo VALUES ('28','home','066490026f95b8929e04aa355fb109e4','20141213_aa32d2823e5f34733d6786dt6ytj4r75_230x230M.jpg','demo/photo/201502/20150215_2658D3958191434973A99E21309C7D81.jpg','32767','1423968391');
INSERT INTO jh_upload_photo VALUES ('29','','5c902effedbacb8f56097747e4f9f416','20141213_9245160673e19d3ddcdfmxi44wr7n47q.jpg','demo/photo/201502/20150215_7A004BF74F5FACC3C40AB4BAD50CD8D3.jpg','32767','1423968481');
INSERT INTO jh_upload_photo VALUES ('30','','6a051e7258db744d3a29c45e243643af','20141213_f54fd01a56da36adce5421inswfdjgng.jpg','demo/photo/201502/20150215_BC759F7E2651D773CEFA3E9D3AE21BA5.jpg','32767','1423968481');
INSERT INTO jh_upload_photo VALUES ('31','','49ba9102230043dc930c2f23856b0a33','20141213_68dc34235be3370bf5c4p533z6wn5bxe.jpg','demo/photo/201502/20150215_4083750E3162E908D09ABF6257DA76CD.jpg','32767','1423968560');
INSERT INTO jh_upload_photo VALUES ('32','','603ad306dd91fa8fae26b4b4d98d4e64','20141213_aa32d2823e5f34733d6786dt6ytj4r75.jpg','demo/photo/201502/20150215_2CF90A3383A7E57D444867FBE8D257DF.jpg','32767','1423968561');
INSERT INTO jh_upload_photo VALUES ('33','','c8206f1076dea846521e51c1e27cc224','20141213_ac19a8e75876dbb00dffzyhkcyz4l17f.jpg','demo/photo/201502/20150215_67931123E3CF1909D831E3DFBFD7348B.jpg','32767','1423968561');
INSERT INTO jh_upload_photo VALUES ('34','','45f1605858fab6ccb25cfcc3c5d4e673','20141213_beba5f4a124c9e606f66z4rdwlt37cty.jpg','demo/photo/201502/20150215_A5FAD1563B506C1175CECCB5BF245241.jpg','32767','1423968562');
INSERT INTO jh_upload_photo VALUES ('35','','5be90da4de8760d1cfea543634f4126d','20141213_d35dd20cf08337be8cc4u0ztz2ycf7vq.jpg','demo/photo/201502/20150215_8923EE39D2353D08EB0F7B17FE277C26.jpg','32767','1423968562');
INSERT INTO jh_upload_photo VALUES ('36','','1d56ac6d851c8c0d0573222c3cf7ca89','20141213_dc23b784c90886ce87afvvtrnss901l6.jpg','demo/photo/201502/20150215_18BD1E21ADFD10213270A3DCB3EAC525.jpg','32767','1423968563');
INSERT INTO jh_upload_photo VALUES ('37','','d09b3e11b8d8e47ab6964b6b1b47323c','20141220_6b52286ec1465bd69b57ifyq3vpp0bdm.jpg','demo/photo/201502/20150215_7BA3E0654EC69F0D03F736910271ECF6.jpg','32767','1423968686');
INSERT INTO jh_upload_photo VALUES ('38','','50f65274f05d5d0054639ed8c83b6e42','20141220_8db1600434b33c28d98cyy7zdi0bglhq.jpg','demo/photo/201502/20150215_B43E151E66505D80B931DF36C59F6818.jpg','32767','1423968687');
INSERT INTO jh_upload_photo VALUES ('39','','d6481d24f5b928f50a06e53c93aa1282','20141220_12e36229acebc201d57fpz9aatby0xb4.jpg','demo/photo/201502/20150215_A5C37FF5F98FE256E69B784A653EDBEA.jpg','32767','1423968687');
INSERT INTO jh_upload_photo VALUES ('40','','1ec842dbebcdd8050f66a397c818cc23','20141220_216394c9d926b62b8480xfhd8nns29nu.jpg','demo/photo/201502/20150215_9BF96CB8EEE56A77B810EADF6C5CA100.jpg','32767','1423968688');
INSERT INTO jh_upload_photo VALUES ('41','','53868ea0e5c2b5f92a1c9e796da0e0ec','20141220_d96fc873c2b3beb0ddb0f6p5hy74px2x.jpg','demo/photo/201502/20150215_97CAAE2587637CE3A1D4EB8794871F74.jpg','32767','1423968688');
INSERT INTO jh_upload_photo VALUES ('42','home','378aa7a3a6f39df116a36a64612a632f','20141224_b2315d8fe15e6bdeac6b2f3uoxfyae37_s.jpg','demo/photo/201502/20150215_5F8BA29B259395040886474FA2DDB287.jpg','14132','1423968973');
INSERT INTO jh_upload_photo VALUES ('43','','0c90d7e6e45ca39a02cd44750cd63d1b','20140915_0fd4f734f6db9de6e2bc8ad81eca51c6.JPG','demo/photo/201502/20150215_AEBA972A0659242D99206C2A73EDBFA1.jpg','32767','1423968995');
INSERT INTO jh_upload_photo VALUES ('44','','34e31051d2eab781e7cbef9eedee243b','20140915_a116653c1850e23600af4779cc7e4566.JPG','demo/photo/201502/20150215_C1B2D4B0C804358775AC85A941547337.jpg','32767','1423968995');
INSERT INTO jh_upload_photo VALUES ('45','','8c355476e953267206261fd94b0eb356','20140915_caf239252cf0244b1b827ea071a5d7a9.JPG','demo/photo/201502/20150215_157A16AB4C8ED14D8212D1FF51FD3F70.jpg','32767','1423968996');
INSERT INTO jh_upload_photo VALUES ('46','home','6f4020eae30df6c72da456fa714e264d','20140609_d8c5108f2aaa070c8aa2bb69f53c3c9c_230x230M.JPG','demo/photo/201502/20150215_0B4A5F75209A9A535B7B60BF54717D67.jpg','32767','1423969374');
INSERT INTO jh_upload_photo VALUES ('47','','ba93e9c3a78bcafd9ea16fc08a5e7b5b','20140408_71adf609afeef820358a0fdbdef43304.jpg','demo/photo/201502/20150215_F34B6F79EAC6F753A4692025E5324AE3.jpg','32767','1423969412');
INSERT INTO jh_upload_photo VALUES ('48','','cf3f4ca93fd0c226e152799b014659c7','20140423_7e8bdbc9b3d677fd60b7fa1c39ef57f3.jpg','demo/photo/201502/20150215_C60506948967CCF409311680764A1F8B.jpg','32767','1423969441');
INSERT INTO jh_upload_photo VALUES ('49','','64560c4658313509419f1b591b6c7451','20140609_7d7afd2dcce4af4bdfab11c188bfcf2d.png','demo/photo/201502/20150215_83603FEA132D06604F0697659B0DC382.png','32767','1423969478');
INSERT INTO jh_upload_photo VALUES ('50','','f7298b64135814f7cb09c93b1883f592','20140609_9147981776eee5367702a27b418582e4.JPG','demo/photo/201502/20150215_1A974E68E911C1BAE004E3CDDA119E25.jpg','32767','1423969478');
INSERT INTO jh_upload_photo VALUES ('51','','6005eaac417c070ced0ea10157ae8379','20140609_1ffbe98dfc8c789bc81e09e1b698f8e3.JPG','demo/photo/201502/20150215_FBA247C8F109EE21C7769CCED799B613.jpg','32767','1423969511');
INSERT INTO jh_upload_photo VALUES ('52','','e91ce106b4aacbd57771c7944c974ba4','20140609_6d9ee793191e9010b93fc0ae44b718c0.JPG','demo/photo/201502/20150215_C96B0EA5194CD5F909630D875887904A.jpg','32767','1423969512');
INSERT INTO jh_upload_photo VALUES ('53','','32c88852f275f7f20915f43427dfd3ff','20140804_679d019a990b626681f13c3ef37250cb.jpg','demo/photo/201502/20150215_B42F3EEA224EB6AA9B51CEDA86C11C57.jpg','32767','1423969552');
INSERT INTO jh_upload_photo VALUES ('54','','8678def4e72b2955769e116418f046df','20140804_23517ed2a1508915a1b9e2f69d75011c.jpg','demo/photo/201502/20150215_4D091A8446DF3F46F143DE26C4F4FCDE.jpg','32767','1423969552');
INSERT INTO jh_upload_photo VALUES ('55','','f6ab940dae129e5be093f8d677898f31','20150206141901_43571.jpg','demo/photo/201502/20150215_A592E2BFA1302580C3022D828518F334.jpg','32767','1423978083');
INSERT INTO jh_upload_photo VALUES ('56','','943d57118a0981a58c10fca81ef3750b','20150206141902_48353.jpg','demo/photo/201502/20150215_683D22E50AF24C2ED195731262AA9CDA.jpg','32767','1423978103');
INSERT INTO jh_upload_photo VALUES ('57','','b624f19aa70972b082a59fb0411b3189','20150206141901_48312.jpg','demo/photo/201502/20150215_2DF4D7CD7D142CCE125B83202F9D9A8E.jpg','32767','1423978140');
INSERT INTO jh_upload_photo VALUES ('58','','428de0430d41bbc44a6193dc4015d193','20150206141902_42283.jpg','demo/photo/201502/20150215_2D35F9CC327540156D6AA402A8FD1D70.jpg','32767','1423978303');
INSERT INTO jh_upload_photo VALUES ('59','','f6310c65cfc557f2b48f5b18c110e472','20150206141902_22538.jpg','demo/photo/201502/20150215_343E16E0FD3F0A81AF44F6D711FAE0E8.jpg','32767','1423978341');
INSERT INTO jh_upload_photo VALUES ('60','','af68042008d1b4d6ff3cbc3c1730ba30','20150206141902_33738.jpg','demo/photo/201502/20150215_F533EF5DDDEF2FA0D6A98E8210C0F18A.jpg','32767','1423978369');
INSERT INTO jh_upload_photo VALUES ('61','','99048517a41a8853f2269dbb28b9d51a','20150206141902_16226 (1).jpg','demo/photo/201502/20150215_9A3E295FB44DA9477F9E17A8909D4D0D.jpg','32767','1423978392');
INSERT INTO jh_upload_photo VALUES ('62','','667ea58344786d0ac1d1aabdfe21287a','20150206142045_54568.jpg','demo/photo/201502/20150215_E00FD757FEBE9EA69BFA37B5446379AF.jpg','32767','1423978412');
INSERT INTO jh_upload_photo VALUES ('63','company','c90ddab444fd254bba39770b5a96fd98','14232036956971_680x300.jpg','demo/photo/201502/20150215_BCB06A8B5B340C489E34F3E14218E387.jpg','32767','1423978520');
INSERT INTO jh_upload_photo VALUES ('64','company','e0f42fd6c966d9a8dfc9181f7ba34f64','thumb_5567.jpg','demo/photo/201502/20150215_00FCD1A2C3F58B26763609F9103E547B.jpg','10408','1423978981');
INSERT INTO jh_upload_photo VALUES ('65','company','e17d8862611ba1be626c1cf633fc6688','thumb_5089.jpg','demo/photo/201502/20150215_01902834BA270A72C5D4A944426E9BC2.jpg','7962','1423979172');
INSERT INTO jh_upload_photo VALUES ('66','company','d1e42e049ea3a95fefbe9dca4e7f3dc6','thumb_5089.jpg','demo/photo/201502/20150215_DA18E2113C3DDDAD459CC197E048C801.jpg','7962','1423979198');
INSERT INTO jh_upload_photo VALUES ('67','company','3957c77332a19b8b75de163cb85a03ba','thumb_5567.jpg','demo/photo/201502/20150215_907813D06960C4B5704EAD4C9CA279D5.jpg','10408','1423979230');
INSERT INTO jh_upload_photo VALUES ('68','activity','6dfab80426a89e4c42783b32962d3fec','288_5202.jpg','demo/photo/201502/20150215_EDA52955CA80C41536D6F5D4F0872403.jpg','32767','1423979786');
INSERT INTO jh_upload_photo VALUES ('69','activity','a2cfb793be5a9032a1ea943ab73553e7','20150204_114636088a44e69b54733SNtomA25Fh4.jpg','demo/photo/201502/20150215_D02D9FF8D455B70E7BCECCBD02CB1F25.jpg','32767','1423979786');
INSERT INTO jh_upload_photo VALUES ('70','diary','81ce910cb0f38e0f346617b1476704f4','20150128_48e52d984bc11ed0282cf3efkjiu68u9.png','demo/photo/201502/20150215_846B02754BDD737ADF2A7CCFFEAEA1CF.png','32767','1423982479');
INSERT INTO jh_upload_photo VALUES ('71','','5fe2f8d61f9f9d1d3936de04238d4320','20150108_49e5468435479002214351tkwuuoigqw_180x180M.jpg','demo/photo/201502/20150215_FBB3CC4111B949EB620B6942E6935A6D.jpg','14669','1423982672');
INSERT INTO jh_upload_photo VALUES ('72','','9195d9294d00f09ab5d97e00601326bf','20150108_4603c6fc13ab7fe6ea20fvhqvunpz6q3_180x180M.jpg','demo/photo/201502/20150215_9082B8B41D7E0A108F5C9F5D15813411.jpg','9548','1423982676');
INSERT INTO jh_upload_photo VALUES ('73','','ff904abbd193d0cd57d2db245be58b0e','20150108_c28ab09813d93766f834ghzqdn02r95p_180x180M.jpg','demo/photo/201502/20150215_E4DDCE641F942DE83511B0A889C088D7.jpg','16245','1423982680');
INSERT INTO jh_upload_photo VALUES ('74','','8ba754256c36974a7c4a2db3b01efd20','20150108_d0ad777cf15fac8b77934wuiqwqexri3_180x180M.jpg','demo/photo/201502/20150215_B67DCEE7407D0B5152BE64B0723972C2.jpg','10321','1423982682');
INSERT INTO jh_upload_photo VALUES ('75','diary','f3c37ff7be50db8b68f71b5e4f283d69','20150112_e1d2e44d290dea2e75b263nexgey9oaq.png','demo/photo/201502/20150215_608ABFAB45FA8F41A045BB303095C3BD.png','32767','1423982904');
INSERT INTO jh_upload_photo VALUES ('76','','2a6ff3e725c0730c1a1d2e1ab92b3bdf','20150109_68d4bd5009c205bac59epjr0a1nfkwky_180x180M.png','demo/photo/201502/20150215_D55844ACA13D787A9073BC639793CEB3.png','32767','1423983044');
INSERT INTO jh_upload_photo VALUES ('77','','28a8974688e976204e2dc76434b443aa','20150109_5716da6eaca3ad584223gsd28wrag1ao_180x180M.png','demo/photo/201502/20150215_927DC0A371CCF71445223665BF80ADE0.png','32767','1423983044');
INSERT INTO jh_upload_photo VALUES ('78','','d627eee49521b88ce4d56724dc061f63','20150109_bb5992930438bc6dfbce4opgpjn3yp6r_180x180M.png','demo/photo/201502/20150215_0EFCD3A1225CC6403B56ADC0B3CB8ACF.png','32767','1423983046');
INSERT INTO jh_upload_photo VALUES ('79','','97b93cda4713251821f2e78b8c40960e','20150109_d266253d9a6e22de919fswbi08dpldlq_180x180M.png','demo/photo/201502/20150215_629161CF2F37E378044326DA605CEB7C.png','32767','1423983047');
INSERT INTO jh_upload_photo VALUES ('80','adv','3a3adaf27bb48810e0caf8888d75bfc1','20141224_1B4004D33C4B5874E4A99762A3AA847B (1).jpg','demo/photo/201502/20150215_77DFC16BC05B6A752F0F53EA46AEEC3A.jpg','32767','1423983145');
INSERT INTO jh_upload_photo VALUES ('81','adv','3e85163272a7b048e9791e91577e5b31','20150126_0671FC048A1F152F7209494BCF6CF48A.jpg','demo/photo/201502/20150215_D7FA10F651CED7EDDB4FA36BB46FAA7D.jpg','32767','1423983157');
INSERT INTO jh_upload_photo VALUES ('82','adv','ce8b59527b3fb79b489480045cee3874','1.jpg','demo/photo/201502/20150215_15D70D7D991171BC0B521571D491C910.jpg','15502','1423983639');
INSERT INTO jh_upload_photo VALUES ('83','adv','ca024ce72b4938c575a3e816821d8ebc','2.jpg','demo/photo/201502/20150215_D546DE8B85F4EA27946A460A643ECB56.jpg','19742','1423983651');
INSERT INTO jh_upload_photo VALUES ('84','adv','5114cd6c1bb1926d47954d8aad8a75c2','3.jpg','demo/photo/201502/20150215_7C17E287EFB9B40AA10750C85BF5A0DB.jpg','17741','1423983661');
INSERT INTO jh_upload_photo VALUES ('85','adv','a677a2834f47ab0c3e87aa9b9896fb73','4.jpg','demo/photo/201502/20150215_1A0057A9FD1B10B9E9FA53D993612E5E.jpg','20956','1423983671');
INSERT INTO jh_upload_photo VALUES ('86','adv','62e2be27a914e4c5851d06aaf953d01f','5.jpg','demo/photo/201502/20150215_90B03AD2AF94FBE366AF376FAE84E3D6.jpg','32767','1423983800');
INSERT INTO jh_upload_photo VALUES ('87','adv','76a1c4c172764ccca273b4d8d47de236','6.jpg','demo/photo/201502/20150215_107402041FF115F67BFDC0B02FC04DD3.jpg','32767','1423983954');
INSERT INTO jh_upload_photo VALUES ('88','adv','ed83c47501103f0bd0fe10ca4a34da11','6.jpg','demo/photo/201502/20150215_21DAF13C491B6DCC1FE77CF9486EAE67.jpg','32767','1423984096');
INSERT INTO jh_upload_photo VALUES ('89','adv','6f054b79fbacf1d05bfd61308e09ead0','8.jpg','demo/photo/201502/20150215_88469EBB53CA8A599EFF8CB01D9ED590.jpg','32767','1423984240');
INSERT INTO jh_upload_photo VALUES ('90','adv','99b1cd2f577ac748331dd078bd46aea1','7.jpg','demo/photo/201502/20150215_2E34FC9191699BF2E505985B56A40AA1.jpg','32767','1423984250');
INSERT INTO jh_upload_photo VALUES ('91','adv','cece74fe3dc466ffd7a7cc304fb29918','10.jpg','demo/photo/201502/20150215_96AA7908CD4B0C90E4E0E39C01222CC1.jpg','17772','1423984369');
INSERT INTO jh_upload_photo VALUES ('92','adv','308eb4aca475b808c42588d91fc8066b','9.jpg','demo/photo/201502/20150215_640018CB3ECFBB82679C0EA66FCB43A4.jpg','19368','1423984381');
INSERT INTO jh_upload_photo VALUES ('93','adv','310ecf5941dea34694c209758db87b33','11.jpg','demo/photo/201502/20150215_09179E99F38AE59F53F67BC973B5B542.jpg','20373','1423985022');
INSERT INTO jh_upload_photo VALUES ('94','adv','85bf9cdd5e10822ba93c41334c8a7d41','12.jpg','demo/photo/201502/20150215_5DBE668122CF26CDA3B8E8C58EC54338.jpg','25981','1423985044');
INSERT INTO jh_upload_photo VALUES ('95','shop','1d77e68aece041e16bb0e51ecee3401e','1212.jpg','demo/photo/201502/20150215_5348EEE9E4FD4864828ABFC9DF988C7C.jpg','32767','1423985465');
INSERT INTO jh_upload_photo VALUES ('1398','config','8683a4cf2e03f7dc0309d8d3600dc840','logo.jpg','photo/201611/20161130_B3493770BCAA7BE60E6DE729D2EB4C0B.jpg','24550','1480495535');
DROP TABLE IF EXISTS jh_upm_task;
CREATE TABLE `jh_upm_task` (
  `task_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `content` varchar(1024) DEFAULT '',
  `stime` int(10) DEFAULT '0',
  `ltime` int(10) DEFAULT '0',
  `uv_num` mediumint(8) DEFAULT '0',
  `uv_credits` smallint(6) DEFAULT '0',
  `uv_money` decimal(8,2) DEFAULT '0.00',
  `yuyue_credits` mediumint(8) DEFAULT '0',
  `yuyue_money` decimal(8,2) DEFAULT '0.00',
  `youxiao_credits` mediumint(8) DEFAULT '0',
  `youxiao_money` decimal(8,2) DEFAULT '0.00',
  `liangfang_credits` mediumint(8) DEFAULT '0',
  `liangfang_money` decimal(8,2) DEFAULT '0.00',
  `qiandan_credits` mediumint(8) DEFAULT '0',
  `qiandan_money` decimal(8,2) DEFAULT '0.00',
  `views` int(10) DEFAULT '0',
  `uv_count` mediumint(8) DEFAULT '0',
  `yuyue_count` mediumint(8) DEFAULT '0',
  `liangfang_count` mediumint(8) DEFAULT '0',
  `qiandan_count` mediumint(8) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

DROP TABLE IF EXISTS jh_upm_task_log;
CREATE TABLE `jh_upm_task_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) DEFAULT '0',
  `sale_id` int(10) DEFAULT '0',
  `pmid` varchar(10) DEFAULT '',
  `yuyue_id` int(10) DEFAULT '0',
  `yuyue_status` tinyint(1) DEFAULT '0',
  `wx_openid` varchar(50) DEFAULT '',
  `hash` char(8) DEFAULT '',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `yuyue_id` (`yuyue_id`,`yuyue_status`),
  KEY `company_id` (`company_id`),
  KEY `pmid` (`sale_id`,`pmid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 AUTO_INCREMENT=83;

DROP TABLE IF EXISTS jh_verify;
CREATE TABLE `jh_verify` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `from` enum('designer','company') DEFAULT NULL,
  `id_photo` varchar(150) DEFAULT '',
  `verify` tinyint(1) DEFAULT '0',
  `qualifications` smallint(3) DEFAULT '0',
  `grade` smallint(3) DEFAULT NULL,
  `verify_time` int(10) DEFAULT '0',
  `request_ip` varchar(15) DEFAULT '0.0.0.0',
  `request_time` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_weixin;
CREATE TABLE `jh_weixin` (
  `wx_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT '0',
  `city_id` smallint(6) DEFAULT '0',
  `wx_sid` varchar(50) DEFAULT '',
  `wx_name` varchar(50) DEFAULT '',
  `weixin` varchar(50) DEFAULT '',
  `admin` tinyint(1) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `face` varchar(255) DEFAULT '',
  `appid` varchar(50) DEFAULT '',
  `secret` varchar(50) DEFAULT '',
  `token` varchar(50) DEFAULT '',
  `access_token` varchar(255) DEFAULT '',
  `expires_in` int(10) DEFAULT '0',
  `addon` mediumtext,
  PRIMARY KEY (`wx_id`),
  KEY `uid` (`uid`),
  KEY `admin` (`city_id`,`admin`),
  KEY `wx_sid` (`wx_sid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_weixin_authcode;
CREATE TABLE `jh_weixin_authcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `type` varchar(10) DEFAULT NULL,
  `addon` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10420 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10420;

DROP TABLE IF EXISTS jh_weixin_coupon;
CREATE TABLE `jh_weixin_coupon` (
  `coupon_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` varchar(30) DEFAULT '0',
  `keyword` varchar(30) DEFAULT '',
  `title` varchar(50) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `stime` int(10) DEFAULT '0',
  `ltime` int(10) DEFAULT '0',
  `use_tips` varchar(1024) DEFAULT '',
  `end_tips` varchar(1024) DEFAULT '',
  `end_photo` varchar(150) DEFAULT '',
  `num` mediumint(8) DEFAULT '0',
  `max_count` mediumint(8) DEFAULT '0',
  `down_count` mediumint(8) DEFAULT '0',
  `use_count` mediumint(8) DEFAULT '0',
  `views` int(10) DEFAULT '0',
  `follower_condtion` tinyint(1) DEFAULT '0',
  `member_condtion` tinyint(1) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 AUTO_INCREMENT=14;

DROP TABLE IF EXISTS jh_weixin_couponsn;
CREATE TABLE `jh_weixin_couponsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 AUTO_INCREMENT=30;

DROP TABLE IF EXISTS jh_weixin_goldegg;
CREATE TABLE `jh_weixin_goldegg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predict_num` int(11) NOT NULL,
  `wx_id` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `title` varchar(60) NOT NULL,
  `use_tips` varchar(200) NOT NULL,
  `stime` int(11) NOT NULL,
  `ltime` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  `aginfo` varchar(200) NOT NULL,
  `end_tips` varchar(60) NOT NULL,
  `end_photo` varchar(100) NOT NULL,
  `fist` varchar(50) NOT NULL,
  `fistnums` int(4) NOT NULL,
  `fistlucknums` int(1) NOT NULL,
  `second` varchar(50) NOT NULL,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `joinnum` int(10) DEFAULT NULL,
  `max_num` int(2) NOT NULL,
  `parssword` int(15) NOT NULL,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL,
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL,
  `follower_condtion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`wx_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 AUTO_INCREMENT=64;

DROP TABLE IF EXISTS jh_weixin_goldeggsn;
CREATE TABLE `jh_weixin_goldeggsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `egg_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `isegg` tinyint(1) DEFAULT NULL,
  `prize` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 AUTO_INCREMENT=116;

DROP TABLE IF EXISTS jh_weixin_help;
CREATE TABLE `jh_weixin_help` (
  `help_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` varchar(30) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `intro` varchar(1024) NOT NULL DEFAULT '',
  `photo` varchar(150) NOT NULL DEFAULT '',
  `stime` int(10) NOT NULL DEFAULT '0',
  `ltime` int(10) NOT NULL DEFAULT '0',
  `use_tips` varchar(1024) NOT NULL DEFAULT '',
  `end_tips` varchar(1204) NOT NULL,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0',
  `max_num` int(10) unsigned NOT NULL DEFAULT '1',
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `end_photo` varchar(150) NOT NULL DEFAULT '',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`help_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

DROP TABLE IF EXISTS jh_weixin_helplist;
CREATE TABLE `jh_weixin_helplist` (
  `list_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `openid` varchar(150) DEFAULT NULL,
  `help_id` mediumint(8) DEFAULT NULL,
  `wx_id` varchar(30) DEFAULT NULL,
  `zhuliid` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

DROP TABLE IF EXISTS jh_weixin_helpprize;
CREATE TABLE `jh_weixin_helpprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `help_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `photo` varchar(225) NOT NULL,
  `wx_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 AUTO_INCREMENT=50;

DROP TABLE IF EXISTS jh_weixin_helpsn;
CREATE TABLE `jh_weixin_helpsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `help_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `zhuanfa` mediumint(8) DEFAULT '0',
  `zhuli` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`),
  UNIQUE KEY `openid` (`openid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 AUTO_INCREMENT=56;

DROP TABLE IF EXISTS jh_weixin_keyword;
CREATE TABLE `jh_weixin_keyword` (
  `kw_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` mediumint(8) DEFAULT '0',
  `wx_sid` varchar(50) DEFAULT '',
  `keyword` varchar(30) DEFAULT NULL,
  `plugin` varchar(50) DEFAULT NULL,
  `len` tinyint(3) DEFAULT '0',
  `type` varchar(30) DEFAULT 'text',
  `reply_id` mediumint(8) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `hits` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`kw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22;

DROP TABLE IF EXISTS jh_weixin_log;
CREATE TABLE `jh_weixin_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weixin` varchar(50) DEFAULT '',
  `data` mediumtext,
  `post` mediumtext,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS jh_weixin_lottery;
CREATE TABLE `jh_weixin_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predict_num` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `wx_id` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `title` varchar(60) NOT NULL,
  `txt` varchar(60) NOT NULL,
  `use_tips` varchar(200) NOT NULL,
  `stime` int(11) NOT NULL,
  `ltime` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  `aginfo` varchar(200) NOT NULL,
  `end_tips` varchar(60) NOT NULL,
  `end_photo` varchar(100) NOT NULL,
  `fist` varchar(50) NOT NULL,
  `fistnums` int(4) NOT NULL,
  `fistlucknums` int(1) NOT NULL,
  `second` varchar(50) NOT NULL,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `allpeople` varchar(30) NOT NULL DEFAULT '',
  `joinnum` int(10) DEFAULT NULL,
  `max_num` int(2) NOT NULL,
  `parssword` int(15) NOT NULL,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL,
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL,
  `follower_condtion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`wx_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 AUTO_INCREMENT=62;

DROP TABLE IF EXISTS jh_weixin_lotterysn;
CREATE TABLE `jh_weixin_lotterysn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lottery_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `islottery` tinyint(1) DEFAULT NULL,
  `prize` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 AUTO_INCREMENT=120;

DROP TABLE IF EXISTS jh_weixin_menu;
CREATE TABLE `jh_weixin_menu` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT '',
  `parent_id` mediumint(8) DEFAULT '0',
  `wx_id` mediumint(8) DEFAULT '0',
  `wx_sid` varchar(50) DEFAULT '',
  `type` enum('reply','text','link') DEFAULT 'text',
  `reply_id` mediumint(8) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `orderby` smallint(6) DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22;

DROP TABLE IF EXISTS jh_weixin_msite;
CREATE TABLE `jh_weixin_msite` (
  `wx_id` mediumint(8) NOT NULL,
  `title` varchar(80) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `tmpl_index` varchar(80) DEFAULT NULL,
  `tmpl_lists` varchar(80) DEFAULT NULL,
  `tmpl_detail` varchar(80) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wx_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_weixin_msite_article;
CREATE TABLE `jh_weixin_msite_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) DEFAULT '0',
  `wx_id` mediumint(8) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `content` mediumtext,
  `link` varchar(255) DEFAULT '',
  `views` mediumint(8) DEFAULT '0',
  `orderby` smallint(6) DEFAULT '50',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

DROP TABLE IF EXISTS jh_weixin_msite_banner;
CREATE TABLE `jh_weixin_msite_banner` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` mediumint(8) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

DROP TABLE IF EXISTS jh_weixin_msite_cate;
CREATE TABLE `jh_weixin_msite_cate` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` mediumint(8) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `orderby` smallint(6) DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

DROP TABLE IF EXISTS jh_weixin_packet;
CREATE TABLE `jh_weixin_packet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` char(25) NOT NULL,
  `title` char(40) NOT NULL,
  `keyword` char(30) NOT NULL,
  `msg_pic` char(120) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `info` text NOT NULL,
  `start_time` char(11) NOT NULL,
  `end_time` char(11) NOT NULL,
  `ext_total` mediumint(8) unsigned NOT NULL,
  `get_number` smallint(5) unsigned NOT NULL,
  `value_count` mediumint(8) unsigned NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `item_num` mediumint(9) NOT NULL,
  `item_sum` mediumint(9) NOT NULL,
  `item_max` mediumint(9) NOT NULL,
  `item_unit` varchar(30) NOT NULL,
  `packet_type` enum('1','2') NOT NULL,
  `deci` smallint(6) NOT NULL,
  `people` mediumint(9) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

DROP TABLE IF EXISTS jh_weixin_packetling;
CREATE TABLE `jh_weixin_packetling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wx_id` char(25) NOT NULL,
  `open_id` char(50) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `price` char(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `type_name` char(45) NOT NULL,
  `time` char(11) NOT NULL,
  `sn_id` text NOT NULL,
  `mobile` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

DROP TABLE IF EXISTS jh_weixin_packetling_copy;
CREATE TABLE `jh_weixin_packetling_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wx_id` char(25) NOT NULL,
  `open_id` char(50) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `price` char(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `type_name` char(45) NOT NULL,
  `time` char(11) NOT NULL,
  `sn_id` text NOT NULL,
  `mobile` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12;

DROP TABLE IF EXISTS jh_weixin_packetsn;
CREATE TABLE `jh_weixin_packetsn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `add_time` char(11) NOT NULL,
  `wx_id` char(25) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `prize_name` char(40) NOT NULL,
  `worth` decimal(10,2) NOT NULL,
  `is_reward` enum('0','1','2') NOT NULL,
  `type` enum('1','2') NOT NULL,
  `code` char(40) NOT NULL,
  `open_id` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 AUTO_INCREMENT=33;

DROP TABLE IF EXISTS jh_weixin_prize;
CREATE TABLE `jh_weixin_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scratch_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `photo` varchar(225) NOT NULL,
  `wx_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 AUTO_INCREMENT=50;

DROP TABLE IF EXISTS jh_weixin_relay;
CREATE TABLE `jh_weixin_relay` (
  `relay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` varchar(30) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `intro` varchar(1024) NOT NULL DEFAULT '',
  `photo` varchar(150) NOT NULL DEFAULT '',
  `stime` int(10) NOT NULL DEFAULT '0',
  `ltime` int(10) NOT NULL DEFAULT '0',
  `use_tips` varchar(1024) NOT NULL DEFAULT '',
  `end_tips` varchar(1204) NOT NULL,
  `relay_num` int(10) unsigned NOT NULL DEFAULT '0',
  `max_num` int(10) unsigned NOT NULL DEFAULT '0',
  `max_gold` mediumint(8) DEFAULT NULL,
  `min_gold` mediumint(8) DEFAULT '30',
  `time` mediumint(8) DEFAULT '30',
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `end_photo` varchar(150) NOT NULL DEFAULT '',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `max_price` int(10) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`relay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 AUTO_INCREMENT=13;

DROP TABLE IF EXISTS jh_weixin_relaylist;
CREATE TABLE `jh_weixin_relaylist` (
  `list_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `openid` varchar(150) DEFAULT NULL,
  `relay_id` mediumint(8) DEFAULT NULL,
  `wx_id` varchar(30) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `jieliid` varchar(50) DEFAULT NULL,
  `gold` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 AUTO_INCREMENT=84;

DROP TABLE IF EXISTS jh_weixin_relayprize;
CREATE TABLE `jh_weixin_relayprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relay_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `photo` varchar(225) NOT NULL,
  `wx_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 AUTO_INCREMENT=51;

DROP TABLE IF EXISTS jh_weixin_relaysn;
CREATE TABLE `jh_weixin_relaysn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relay_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `cishu` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`),
  UNIQUE KEY `openid` (`openid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 AUTO_INCREMENT=62;

DROP TABLE IF EXISTS jh_weixin_reply;
CREATE TABLE `jh_weixin_reply` (
  `reply_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` mediumint(8) DEFAULT '0',
  `title` varchar(80) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `jumpurl` varchar(255) DEFAULT '',
  `content` mediumtext,
  `views` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`reply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

DROP TABLE IF EXISTS jh_weixin_scratch;
CREATE TABLE `jh_weixin_scratch` (
  `scratch_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` varchar(30) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `intro` varchar(1024) NOT NULL DEFAULT '',
  `photo` varchar(150) NOT NULL DEFAULT '',
  `stime` int(10) NOT NULL DEFAULT '0',
  `ltime` int(10) NOT NULL DEFAULT '0',
  `use_tips` varchar(1024) NOT NULL DEFAULT '',
  `end_tips` varchar(1204) NOT NULL,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0',
  `max_num` int(10) unsigned NOT NULL DEFAULT '1',
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `end_photo` varchar(150) NOT NULL DEFAULT '',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`scratch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

DROP TABLE IF EXISTS jh_weixin_scratchsn;
CREATE TABLE `jh_weixin_scratchsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scratch_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `prize_id` int(10) DEFAULT NULL,
  `prize_title` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 AUTO_INCREMENT=41;

DROP TABLE IF EXISTS jh_weixin_shake;
CREATE TABLE `jh_weixin_shake` (
  `shake_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` varchar(255) DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `intro` varchar(1024) NOT NULL DEFAULT '',
  `photo` varchar(150) NOT NULL DEFAULT '',
  `stime` int(10) DEFAULT '0',
  `ltime` int(10) DEFAULT NULL,
  `use_tips` varchar(1024) NOT NULL DEFAULT '',
  `end_tips` varchar(1204) NOT NULL,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0',
  `max_num` int(10) unsigned NOT NULL DEFAULT '1',
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `end_photo` varchar(150) NOT NULL DEFAULT '',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`shake_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

DROP TABLE IF EXISTS jh_weixin_shakeprize;
CREATE TABLE `jh_weixin_shakeprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shake_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `photo` varchar(225) NOT NULL,
  `wx_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 AUTO_INCREMENT=49;

DROP TABLE IF EXISTS jh_weixin_shakesn;
CREATE TABLE `jh_weixin_shakesn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shake_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `wx_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `prize_id` int(10) DEFAULT NULL,
  `prize_title` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 AUTO_INCREMENT=36;

DROP TABLE IF EXISTS jh_weixin_tenders;
CREATE TABLE `jh_weixin_tenders` (
  `tenders_id` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  PRIMARY KEY (`tenders_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS jh_weixin_tmplmsg;
CREATE TABLE `jh_weixin_tmplmsg` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(30) DEFAULT '',
  `title` varchar(30) DEFAULT '',
  `TMID` varchar(30) DEFAULT '',
  `tmpl` mediumtext,
  `template_id` varchar(255) DEFAULT '',
  `topcolor` varchar(10) DEFAULT '',
  `textcolor` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

DROP TABLE IF EXISTS jh_zxb;
CREATE TABLE `jh_zxb` (
  `zxb_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(6) DEFAULT '0',
  `tenders_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `company_id` mediumint(8) DEFAULT '0',
  `contact` varchar(30) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `comment` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `remark` varchar(255) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`zxb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 AUTO_INCREMENT=61;

DROP TABLE IF EXISTS jh_zxb_hetong;
CREATE TABLE `jh_zxb_hetong` (
  `hetong_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `zxb_id` mediumint(8) unsigned DEFAULT NULL,
  `uid` mediumint(8) DEFAULT '0',
  `company_id` mediumint(8) DEFAULT '0',
  `total_price` mediumint(8) DEFAULT '0',
  `hetong` varchar(150) DEFAULT '',
  `yezhu` varchar(30) DEFAULT '',
  `yezhu_phone` varchar(15) DEFAULT '',
  `yezhu_bank` varchar(150) DEFAULT '',
  `yezhu_status` tinyint(1) DEFAULT '0',
  `yezhu_time` int(10) DEFAULT '0',
  `company` varchar(80) DEFAULT '',
  `company_phone` varchar(15) DEFAULT '',
  `company_bank` varchar(150) DEFAULT '',
  `company_status` tinyint(1) DEFAULT '0',
  `company_time` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`hetong_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 AUTO_INCREMENT=24;

DROP TABLE IF EXISTS jh_zxb_photo;
CREATE TABLE `jh_zxb_photo` (
  `photo_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `zxb_id` mediumint(8) NOT NULL,
  `company_id` mediumint(8) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `step` tinyint(1) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 AUTO_INCREMENT=82;

DROP TABLE IF EXISTS jh_zxb_plaint;
CREATE TABLE `jh_zxb_plaint` (
  `plaint_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `zxb_id` mediumint(8) NOT NULL,
  `uid` mediumint(8) DEFAULT NULL,
  `company_id` mediumint(8) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `yezhu_photo` varchar(225) DEFAULT NULL,
  `yezhu_content` mediumtext,
  `yezhu_time` int(10) DEFAULT NULL,
  `company_photo` varchar(225) DEFAULT NULL,
  `company_content` mediumtext,
  `company_time` int(10) DEFAULT NULL,
  `content` mediumtext,
  `status` tinyint(1) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`plaint_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

DROP TABLE IF EXISTS jh_zxb_step;
CREATE TABLE `jh_zxb_step` (
  `step_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `zxb_id` mediumint(8) DEFAULT '0',
  `uid` mediumint(8) DEFAULT NULL,
  `company_id` mediumint(8) DEFAULT NULL,
  `step` tinyint(3) DEFAULT '0',
  `yezhu_photo` varchar(225) DEFAULT NULL,
  `yezhu_content` mediumtext,
  `yezhu_status` tinyint(1) DEFAULT NULL,
  `yezhu_time` int(10) DEFAULT NULL,
  `company_content` mediumtext,
  `company_status` tinyint(1) DEFAULT NULL,
  `company_time` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `content` mediumtext,
  `time` int(10) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`step_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 AUTO_INCREMENT=91;

DROP TABLE IF EXISTS jh_zxpm_item;
CREATE TABLE `jh_zxpm_item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `location` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

DROP TABLE IF EXISTS jh_zxpm_photo;
CREATE TABLE `jh_zxpm_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) DEFAULT '0',
  `item_id` int(10) DEFAULT '0',
  `photo` varchar(150) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

