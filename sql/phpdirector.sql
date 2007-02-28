-- MySQL dump 9.11
--
-- Host: localhost    Database: phpdirector
-- ------------------------------------------------------
-- Server version	4.0.24_Debian-10sarge2-log

--
-- Table structure for table `pp_files`
--

CREATE TABLE `pp_files` (
  `id` int(64) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `creator` varchar(64) NOT NULL default '',
  `description` longtext NOT NULL,
  `date` date NOT NULL default '2007-01-01',
  `file` varchar(36) NOT NULL default '',
  `approved` char(2) NOT NULL default '',
  `feature` char(2) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `picture` varchar(60) NOT NULL default '',
  `category` varchar(20) NOT NULL default '0',
  `reject` char(2) default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Dumping data for table `pp_files`
--

INSERT INTO `pp_files` VALUES (12,'Owww park thing!','MandyxMassacre','Idk me at the park on this thingy..it really hut!','2006-11-30','W-WXXC8I1r4','1','0','192.168.0.10','http://sjl-static2.sjl.youtube.com/vi/W-WXXC8I1r4/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (11,'rising star','jeppebrilo','rising tv star','2006-11-30','AySjb1qQt9A','1','0','192.168.0.10','http://sjl-static15.sjl.youtube.com/vi/AySjb1qQt9A/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (13,'Why Do You Tube?','boh3m3','What are you looking at this for? Make a response!','2006-12-01','vPl6QeK87sM','1','0','192.168.0.10','http://sjc-static4.sjc.youtube.com/vi/vPl6QeK87sM/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (15,'The Passenger','TheReceptionist','The clickity clack of the minds\' split track.','2006-12-01','0vdG-FwpulQ','1','0','192.168.0.10','http://sjl-static7.sjl.youtube.com/vi/0vdG-FwpulQ/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (17,'Ostrich Head\'s Freak Show Carnival','OstrichHead','Ostrich Head / LaLa FIlms present - Freak Show Carnival\r\n\r\nDirected and Produced by: Jordan Blake Allen &amp; Seth Freedman\r\n\r\nVFX by: Farmer Brown\r\nEditing by: Michael Polier\r\n\r\nLaLa Films is now looking for future projects - please contact us lalafilms@mac.com','2006-12-01','fGm-gwHwgcQ','1','0','192.168.0.10','http://sjc-static13.sjc.youtube.com/vi/fGm-gwHwgcQ/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (28,'Weird Al - Behind the Scenes of \"White and Nerdy\"','digitube1','Go behind the scenes of Weird Al\'s \"White and Nerdy\" video from his new album Straight Outta Lynwood, in stores now.','2006-12-03','1TDAGJMj8zk','1','0','192.168.0.10','http://sjl-static5.sjl.youtube.com/vi/1TDAGJMj8zk/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (45,'THE CONSUMERIST: Tekserve Ad with over $60,000 in ipods','consumerist','So many ipods. I wonder if any of their screens cracked in making this?','2007-01-16','5Lby0i0TUvQ','1','0','192.168.0.3','http://sjl-static9.sjl.youtube.com/vi/5Lby0i0TUvQ/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (46,'The Other Son','BaratsAndBereta','What Would Wesley Do?','2007-01-16','NFwvs8eYt6E','1','0','192.168.0.3','http://sjl-static13.sjl.youtube.com/vi/NFwvs8eYt6E/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (29,'Sleeper Cell: A New Cell Awakens','CBS','Don\'t miss Sleeper Cell: American Terror, December 10 - 17, each night at 9PM ET/PT.','2006-12-10','5bry10DU8bo','1','0','192.168.0.10','http://sjc-static15.sjc.youtube.com/vi/5bry10DU8bo/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (30,'YUMIKO空中飛褲','siubing127','為慈善為到咁,都無野好講lor!!','2006-12-10','c6vLYI8UI7E','0','0','192.168.0.10','http://sjc-static7.sjc.youtube.com/vi/c6vLYI8UI7E/2.jpg','0','1');
INSERT INTO `pp_files` VALUES (31,'Yumiko\'s jeans fall down','TOMMYtomy','good','2006-12-10','_oyUDvEbPEI','1','0','192.168.0.10','http://sjc-static9.sjc.youtube.com/vi/_oyUDvEbPEI/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (32,'WoW Burning Crusade Opening Cinematics Premiere @ VGA  2006','lilfuzz6','Sorry for the bad angle + things in the way, oh and do ignore my retarded laughing plus fan girl-ness at the end. I had crappy seats in the house (though tickets were free) the sound was nice though, enjoy!','2006-12-10','_0WxrEmZlvE','1','1','192.168.0.10','http://sjl-static3.sjl.youtube.com/vi/_0WxrEmZlvE/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (33,'vcents','consumerist','ver1zon doesn\'t know the difference between .002 cents and .002 dollars\r\n\r\ncheck out the story here:\r\nhttp://tinyurl.com/yl2fvz','2006-12-10','Gp0HyxQv97Q','1','0','192.168.0.10','http://sjc-static1.sjc.youtube.com/vi/Gp0HyxQv97Q/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (35,'Undignified Offering','ben6664','THIS IS ONLY 1st Half second half on crossstar.co.uk\r\n\r\nps. my favorite part is in the second half','2006-12-28','jr3JEwXtudA','1','0','192.168.0.10','http://sjc-static4.sjc.youtube.com/vi/jr3JEwXtudA/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (36,'Love Letters - An Animated Proposal - v2.0','worldofjeff','I produced this animation as a way of proposing to my girlfriend (now wife) Natasha. I assembled a team of 20 animators to assist me, including co-workers, as well as students from my 3D character animation class at the Art Institute of California-San Francisco. We created more than four minutes of animation in just three months. When it was completed, I surprised Natasha by bringing her to the Parkway Movie Theater in Oakland, where they played the animation on the big screen in front of over 100 of our friends and family. The entire event was filmed for the TLC television show \"A Perfect Proposal.\"\r\n\r\nDirector\'s Note: I pulled a George Lucas and retrofitted the opening shot of the animation to show a photo of the Natasha design from \"The Invitation\" rather than the earlier drawing of Natsha I had done, which I was never quite satisfied with. Also, after receiving many a tersely written emails, I finally decided to listen to the fans and have completely removed all scenes with Jar Jar Binks.','2006-12-30','Syxwkc36jas','0','0','192.168.0.10','http://sjc-static3.sjc.youtube.com/vi/Syxwkc36jas/2.jpg','0','1');
INSERT INTO `pp_files` VALUES (37,'Gnarls Barkley \"Crazy\" Live','AtlanticVideos','Gnarls Barkley performs \"Crazy\" live on New Year\'s Eve in Los Angeles','2007-01-01','_kYYgnyMx0E','1','0','192.168.0.10','http://sjc-static11.sjc.youtube.com/vi/_kYYgnyMx0E/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (40,'Dove Cream Oil Body Wash','mjnes','The Dove(R) Brand Invites Women to Create a :30 TV Ad for New Dove(R) Cream Oil Body Wash To Air During 79th Annual Academy Awards(R)during a commercial break. Click on the banner above to learn more!','2007-01-10','PIRS95CbJNw','1','0','192.168.0.10','http://sjc-static8.sjc.youtube.com/vi/PIRS95CbJNw/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (41,'Liverpool   3 - 6   Arsenal','benplanet2002','League Cup highlights - Liverpool 3-6 Arsenal: The Beast runs wild\r\nStunned Liverpool were humbled in their own back yard by Arsene Wenger\'s youngsters and sent tumbling out of the Carling Cup on the back of a 6-3 hiding.','2007-01-10','hujXjOftocs','0','0','192.168.0.10','http://sjl-static5.sjl.youtube.com/vi/hujXjOftocs/2.jpg','0','1');
INSERT INTO `pp_files` VALUES (43,'Puehse Twins Skateboarding','groms','8 year-old skateboarding twins Tristan &amp; Nic Puehse.  www.skateboardingtwins.com','2007-01-12','8X2_zsnPkq8','0','0','192.168.0.10','http://sjc-static17.sjc.youtube.com/vi/8X2_zsnPkq8/2.jpg','0','1');
INSERT INTO `pp_files` VALUES (47,'The YouTube Guided Tour','JackDanyells','Welcome to YouTube newbies. And if you\'re a YouTube vet, you can still stick around. You might learn a thing or two.\r\n\r\n\r\nVideo F.A.Q.\r\n\r\n1. I used Adobe Premiere 2.0 and a homemade green screen\r\n2. Yes, I am WELL aware of the fact that I can\'t act.\r\n3. Yes, you can have a FULL 5 minutes of your life back. Just remember, when you\'re on your death bad, that last breath is on me.\r\n4. To learn how to make a green screen watch Therapix\'s tutorial (attached as a video response).','2007-01-16','dcZ-bAZtC34','1','0','192.168.0.3','http://sjl-static6.sjl.youtube.com/vi/dcZ-bAZtC34/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (48,'Viral Video Genius','nalts','Viral Video Czar Kevin Nalty, also known as Nalts, shares his inspiration on what makes him an undiscovered legend of viral video.\r\n\r\n** Thanks for featuring me, YouTube. I now hold honors for the LOWEST views in a featured video! I promise I\'ll be nice from now on. \r\n\r\nFor more of Nalts see username GOOTUBECONSPIRACY and MEDIAMOGIRL.','2007-01-16','aXJVxmWTmkg','1','0','192.168.0.3','http://sjc-static4.sjc.youtube.com/vi/aXJVxmWTmkg/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (50,'World Freehand Circle Drawing Champion','gravylookout','Alexander Overwijk draws a perfect freehand circle 1m in diameter in less than a second.','2007-01-16','eAhfZUZiwSE','1','0','192.168.0.3','http://sjl-static4.sjl.youtube.com/vi/eAhfZUZiwSE/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (51,'engagement india','susiefusion','david asked susie to marry him in the hills of Matheran','2007-01-16','hjoCsZpTv8s','1','0','192.168.0.3','http://sjc-static9.sjc.youtube.com/vi/hjoCsZpTv8s/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (52,'The Original Cuppycake Video','sonoman','Thanks for the feature, YouTube!\r\n\r\nNo lip-syncing here folks, This is the REAL DEAL!: The original 1994 video of \"The Cuppycake Song\" (words and music by Judianna Castle) being recorded by the original artist (our daughter, Amy at age 3) in our home studio. Although there were many takes of the song during the session, this was the one that made it onto our BALLOONS children\'s CD(www.cdbaby.com/buddycastle)and the one which has generated so much interest on the internet. Since uploading \"The Cuppycake Song\" to the web in 1996, it has truly taken on a life of it\'s own. On You Tube alone, there are currently at least 400 videos using this song! In the last ten years we have received thousands of unsolicited comments from people of all ages across the US and many countries around the world who have been touched by this simple song and the tiny voice that sings it. Now at last, you can see the face that goes with the voice. This should finally put to rest the false rumor that the song was sung by Strawberry Shortcake. (Hallmark should turn this into an audio greeting card before the competition does.) \r\nTo read some of the many listener comments and to see additional photos of Amy, please visit us at www.cuppycake.com Get the ringtone at www.jivjiv.com\r\nAmy will be 17 in April and is now into creating \r\nand editing her own videos: \r\nhttp://www.youtube.com/watch?v=kQeGpmxcXMI','2007-01-16','12Z6pWhM6TA','1','0','192.168.0.3','http://sjc-static13.sjc.youtube.com/vi/12Z6pWhM6TA/2.jpg','0','0');
INSERT INTO `pp_files` VALUES (53,'\"Ron Ronsmith and the Fake News\"','sxephil','A News Show that makes fun of itself and other YouTubers.  Be sure to check out \"Take Two\" with Ron Ronsmith.\r\n\r\nA big thanks to MGM for doing an amazing intro (I think its better than the video :) ), be sure to check his youtube channel.\r\n\r\nhttp://www.youtube.com/mysteryguitarman\r\n\r\n*NOTE*:  I have semi-fixed the lighting issue in (Take-2) which is a response to this one, check it out.','2007-01-16','WwlD5tfi8Hw','0','0','192.168.0.3','http://sjl-static15.sjl.youtube.com/vi/WwlD5tfi8Hw/2.jpg','0','1');

--
-- Table structure for table `pp_rating`
--

CREATE TABLE `pp_rating` (
  `id` varchar(11) NOT NULL default '',
  `total_votes` varchar(11) NOT NULL default '0',
  `total_value` varchar(11) NOT NULL default '0',
  `used_ips` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Dumping data for table `pp_rating`
--

INSERT INTO `pp_rating` VALUES ('37','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('38','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('30','2','7','a:2:{i:0;s:12:\"192.168.0.10\";i:1;s:11:\"192.168.0.4\";}');
INSERT INTO `pp_rating` VALUES ('32','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('29','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('35','4','15','a:3:{i:0;s:12:\"192.168.0.10\";i:1;s:11:\"192.168.0.4\";i:2;s:11:\"192.168.0.3\";}');
INSERT INTO `pp_rating` VALUES ('36','2','6','a:2:{i:0;s:12:\"192.168.0.10\";i:1;s:11:\"192.168.0.4\";}');
INSERT INTO `pp_rating` VALUES ('33','1','2','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('28','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('12','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('13','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('17','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('45','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('31','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('52','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('48','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('458','1','5','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('485','1','2','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('45438','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('484','1','2','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('42128','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('41128','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('4218','1','2','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('40078','1','3','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('448','1','2','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('428','1','4','a:1:{i:0;s:12:\"192.168.0.10\";}');
INSERT INTO `pp_rating` VALUES ('47','0','0','');

