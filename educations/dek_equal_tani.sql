
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;




CREATE TABLE `activity` (
`actid` bigint(20) NOT NULL COMMENT 'รหัสกิจกรรม',
`actnme` varchar(50) DEFAULT NULL COMMENT 'ชื่อกิจกรรม',
`acttypid` int(2) DEFAULT NULL COMMENT 'รหัสประเภทกิจกรรม',
`actdtestr` varchar(8) DEFAULT NULL COMMENT 'วันที่เริ่มจัดกิจกรรม',
`actdteend` varchar(8) DEFAULT NULL COMMENT 'วันที่จัดกิจกรรมเสร็จ',
`actplc` varchar(100) DEFAULT NULL COMMENT 'สถานที่จัดกิจกรรม',
`plcid` varchar(6) DEFAULT NULL COMMENT 'จังหวัดอำเภอตำบล ที่จัดกิจกรรม',
`actattdno` int(5) DEFAULT NULL COMMENT 'จำนวนผู้เข้าร่วมกิจกรรม',
`actdetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดการจัดกิจกรรม'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มกิจกรรมของอบจ. ที่ทำเกี่ยวกับประเด็นความเหลื่อมล้ำของเด็ก';



CREATE TABLE `acttyp` (
`acttypid` int(2) NOT NULL COMMENT 'รหัสประเภทกิจกรรม',
`acttypnme` varchar(50) NOT NULL COMMENT 'ชื่อประเภทกิจกรรม'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลประเภทกิจกรรม';



CREATE TABLE `agrland` (
`agrlandid` int(2) NOT NULL COMMENT 'รหัสขนาดของที่ดิน',
`agrlandnme` varchar(50) NOT NULL COMMENT 'ชื่อขนาดของที่ดิน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลที่ดินสำหรับทำการเกษตร';



CREATE TABLE `child` (
`perid` bigint(20) NOT NULL COMMENT 'รหัสเด็ก',
`chiphoto` varchar(20) DEFAULT NULL COMMENT 'รูปถ่ายเด็ก',
`chiord` int(2) DEFAULT NULL COMMENT 'เป็นบุตรคนที่เท่าไหร่',
`livewid` int(2) DEFAULT NULL COMMENT 'นักเรียนอาศัยอยู่กับใคร',
`famsttid` int(2) DEFAULT NULL COMMENT 'รหัสสถานภาพครอบครัว',
`distschkm` int(3) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ระยะทางกี่กิโลเมตรกี่เมตร)',
`distschm` int(3) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ระยะทางกี่กิโลเมตรกี่เมตร)',
`distschhrs` int(2) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ใช้เวลากี่ชั่วโมงกี่นาที)',
`distschmin` int(2) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ใช้เวลากี่ชั่วโมงกี่นาที)',
`schmethid` int(2) DEFAULT NULL COMMENT 'รหัสวิธีเดินทางหลัก',
`chidetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดเชิงคุณภาพ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลเฉพาะเด็ก';



CREATE TABLE `const_plcnmegen` (
`prvidgen` varchar(2) NOT NULL DEFAULT '' COMMENT 'รหัสจังหวัด',
`ampidgen` varchar(2) NOT NULL COMMENT 'รหัสอำเภอ',
`tmbidgen` varchar(2) NOT NULL COMMENT 'รหัสตำบล',
`prvnmegen` varchar(30) DEFAULT NULL COMMENT 'ชื่อจังหวัด',
`ampnmegen` varchar(24) DEFAULT NULL COMMENT 'ชื่ออำเภอ',
`tmbnmegen` varchar(20) DEFAULT NULL COMMENT 'ชื่อตำบล',
`plcidgen` varchar(6) NOT NULL,
`plcnmegen` varchar(82) DEFAULT NULL,
`regionnme` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `const_vllnmegen` (
`prvidgen` varchar(2) NOT NULL COMMENT 'รหัสจังหวัด',
`ampidgen` varchar(2) NOT NULL COMMENT 'รหัสอำเภอ',
`tmbidgen` varchar(2) NOT NULL COMMENT 'รหัสตำบล',
`vllidgen` varchar(2) NOT NULL COMMENT 'รหัสหมู่บ้าน',
`vllnmegen` varchar(110) DEFAULT NULL COMMENT 'ชื่อหมู่บ้าน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `dispform` (
`dispfrmid` int(2) NOT NULL COMMENT 'รหัสลักษณะความเหลื่อมล้ำ',
`dispfrmnme` varchar(50) NOT NULL COMMENT 'ชื่อลักษณะความเหลื่อมล้ำ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลลักษณะความเหลื่อมล้ำ';



CREATE TABLE `disptyp` (
`disptypid` bigint(20) NOT NULL COMMENT 'รหัสความเหลื่อมล้ำ',
`dispfrmid` int(2) DEFAULT NULL COMMENT 'รหัสลักษณะความเหลื่อมล้ำ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลประเภทความเหลื่อมล้ำ';



CREATE TABLE `edulev` (
`eduid` int(2) NOT NULL COMMENT 'รหัสระดับการศึกษาสูงสุด',
`edulevnme` varchar(100) NOT NULL COMMENT 'ชื่อระดับการศึกษาสูงสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ระดับการศึกษาสูงสุด';



CREATE TABLE `famstt` (
`famsttid` int(2) NOT NULL COMMENT 'รหัสสถานภาพครอบครัว',
`famsttnme` varchar(50) NOT NULL COMMENT 'ชื่อสถานภาพครอบครัว'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลสถานภาพครอบครัว';



CREATE TABLE `gender` (
`genid` int(2) UNSIGNED NOT NULL COMMENT 'รหัสเพศ',
`gennme` varchar(10) NOT NULL COMMENT 'ชื่อเพศ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลเพศ';



CREATE TABLE `hedu` (
`heduid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการศึกษา',
`eduid` int(2) DEFAULT NULL COMMENT 'ระดับการศึกษา',
`edulev` int(1) DEFAULT NULL COMMENT 'ชั้นปี',
`edusemester` int(6) DEFAULT NULL COMMENT 'ปีการศึกษา',
`edugrade` decimal(4,2) DEFAULT NULL COMMENT 'เกรดเฉลี่ย',
`edudetail` varchar(200) DEFAULT NULL COMMENT 'รายละเอียดอื่น ๆ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางประวัติการศึกษา';



CREATE TABLE `hfolowup` (
`hflwid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการติดตาม/การเยี่ยมเยียน',
`hflwdtestr` varchar(8) DEFAULT NULL COMMENT 'วันที่เริ่มติดตาม/เยี่ยมเยียน (แต่ละครั้ง) เปิดไว้กรณีติดตามหลายวัน',
`hflwdteend` varchar(8) DEFAULT NULL COMMENT 'วันที่ติดตาม/เยี่ยมเยียนเสร็จ',
`hflwmeth` int(1) DEFAULT NULL COMMENT 'ติดตาม/เยี่ยมเยียนด้วยวิธีใด',
`hflwdetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดการติดตาม/เยี่ยมเยียน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มประวัติการติดตาม/การเยี่ยมเยียน';



CREATE TABLE `hhdepon` (
`hhdeponid` int(2) NOT NULL COMMENT 'รหัสครัวเรือนมีภาระพึ่งพิง',
`hhdeponnme` varchar(50) NOT NULL COMMENT 'ชื่อครัวเรือนมีภาระพึ่งพิง'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลครัวเรือนมีภาระพึ่งพิง';



CREATE TABLE `hhelect` (
`hhelectid` int(2) NOT NULL COMMENT 'รหัสแหล่งไฟฟ้า',
`hhelectnme` varchar(50) NOT NULL COMMENT 'ชื่อแหล่งไฟฟ้า'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลแหล่งไฟฟ้า';



CREATE TABLE `hhelpedu` (
`hheduid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการช่วยเหลือด้านการศึกษา',
`eduid` int(2) DEFAULT NULL COMMENT 'ระดับการศึกษาขณะที่ได้รับการช่วยเหลือ (Foreign Key) มีตารางย่อย',
`hedulev` int(1) DEFAULT NULL COMMENT 'ชั้นปีที่ได้รับทุน',
`hedusemester` int(6) DEFAULT NULL COMMENT 'ปีการศึกษาที่ได้รับทุน เก็บ 6 หลัก เช่น 256601',
`hedufundtyp` int(1) DEFAULT NULL COMMENT 'เป็นทุนรายเดือนหรือปีหรือครั้งคราว (1=รายเดือน, 2=รายปี, 3=รายครั้งคราว)',
`hedumoney` int(6) DEFAULT NULL COMMENT 'จำนวนเงินที่ได้รับต่อครั้ง หน่วย:: บาท/เดือน บาท/ปี บาท/ครั้ง',
`hedudetail` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'รายละเอียดอื่น ๆ'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `hhelpjob` (
`hhjobid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการช่วยเหลือด้านอาชีพ',
`hjobdte` varchar(8) DEFAULT NULL COMMENT 'วันที่ให้ความช่วยเหลือ',
`hjobmoney` int(1) DEFAULT NULL COMMENT 'ลักษณะการช่วยเหลือ:: ให้เงินสด (1=yes, 0=no)',
`hjobobject` int(1) DEFAULT NULL COMMENT 'ลักษณะการช่วยเหลือ:: ให้สิ่งของ/อุปกรณ์ (1=yes, 0=no)',
`hjobknowledge` int(1) DEFAULT NULL COMMENT 'ลักษณะการช่วยเหลือ:: ให้ความรู้ (1=yes, 0=no)',
`hjobtranfer` int(1) DEFAULT NULL COMMENT 'ลักษณะการช่วยเหลือ:: ส่งต่อให้หน่วยงาน (1=yes, 0=no)',
`hjobdetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดการช่วยเหลือ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มประวัติการช่วยเหลือด้านอาชีพ';



CREATE TABLE `hhflr` (
`hhflrid` int(2) NOT NULL COMMENT 'รหัสวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)',
`hhflrnme` varchar(50) NOT NULL COMMENT 'ชื่อวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช่ใต้ถุนบ้าน)';



CREATE TABLE `hhold` (
`hholdid` bigint(20) NOT NULL COMMENT 'รหัสครัวเรือน',
`adr` varchar(20) DEFAULT NULL COMMENT 'ที่อยู่ปัจจุบัน บ้านเลขที่',
`soi` varchar(30) DEFAULT NULL COMMENT 'ถนน ซอย',
`vllid` varchar(2) DEFAULT NULL COMMENT 'หมู่ที่',
`plcid` varchar(6) DEFAULT NULL COMMENT 'จังหวัดอำเภอตำบล',
`postcode` int(5) DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
`memno` int(2) DEFAULT NULL COMMENT 'จำนวนสมาชิกในครัวเรือน (รวมตัวนักเรียน)',
`hhdeponid` int(2) DEFAULT NULL COMMENT 'รหัสครัวเรือนมีภาระพึ่งพิง',
`hhtypid` int(2) DEFAULT NULL COMMENT 'รหัสการอยู่อาศัย',
`hhrent` int(5) DEFAULT NULL COMMENT 'กรณีอยู่บ้านเช่า เช่าเดือนละกี่บาท',
`hhflrid` int(2) DEFAULT NULL COMMENT 'รหัสวัสดุที่ใช้ทำพื้นบ้าน (ที่ไม่ใช้ใต้ถุนบ้าน)',
`hhwallid` int(2) DEFAULT NULL COMMENT 'รหัสวัสดุที่ใช้ทำฝาบ้าน',
`hhrfid` int(2) DEFAULT NULL COMMENT 'รหัสวัสดุที่ใช้ทำหลังคา',
`hhtoilet` int(1) DEFAULT NULL COMMENT 'มีห้องส้วมในที่อยู่อาศัย/บริเวณบ้าน (1=yes, 0=no)',
`havagrland` int(1) DEFAULT NULL COMMENT 'มีดินทำการเกษตรได้(รวมเช่า) (0=ไม่ทำเกษตร, 1=ทำเกษตร)',
`agrlandid` int(2) DEFAULT NULL COMMENT 'กรณีทำการเกษตร มีที่ดินจำนวนกี่ไร่',
`hhwaterid` int(2) DEFAULT NULL COMMENT 'รหัสแหล่งน้ำดื่ม',
`havelect` int(1) DEFAULT NULL COMMENT 'มีไฟฟ้าใช้หรือไม่ (0=ไม่มีไฟฟ้า/ไม่มีเครื่องกำเนิดไฟฟ้าชนิดอื่น ๆ, 1=มีไฟฟ้า)',
`hhelectid` int(2) DEFAULT NULL COMMENT 'กรณีมีไฟฟ้าใช้ ให้ระบุแหล่งไฟฟ้า',
`vhcar` int(1) DEFAULT NULL COMMENT 'ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถยนต์นั่งส่วนบุคคล (1=yes, 0=no)',
`vhcarage` int(1) DEFAULT NULL COMMENT 'อายุ:: รถยนต์นั่งส่วนบุคคล (1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี)',
`vhtruck` int(1) DEFAULT NULL COMMENT 'ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้ (1=yes, 0=no)',
`vhtruckage` int(1) DEFAULT NULL COMMENT 'อายุ:: รถปิกอัพ/รถบรรทุกเล็ก/รถตู้ (1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี)',
`vhtractor` int(1) DEFAULT NULL COMMENT 'ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน (1=yes, 0=no)',
`vhtractorage` int(1) DEFAULT NULL COMMENT 'อายุ:: รถไถ/รถเกี่ยวข้าว/รถประเภทเดียวกัน (1=อายุเกิน 15 ปี, 2=ไม่เกิน 15 ปี)',
`vhmbike` int(1) DEFAULT NULL COMMENT 'ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: รถมอเตอร์ไซต์/เรือประมงพื้นบ้าน (ขนาดเล็ก) (1=yes, 0=no)',
`vhno` int(1) DEFAULT NULL COMMENT 'ยานพาหนะในครัวเรือน (ที่ใช้งานได้):: ไม่มียานพาหนะในครัวเรือน (1=yes, 0=no)',
`hitemcomputer` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: คอมพิวเตอร์ (1=yes, 0=no)',
`hitemaircon` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: แอร์ (1=yes, 0=no)',
`hitemtvflat` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: ทีวีจอแบน (1=yes, 0=no)',
`hitemwashmachine` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: เครื่องซักผ้า (1=yes, 0=no)',
`hitemrefrige` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: ตู้เย็น (1=yes, 0=no)',
`hitemno` int(1) DEFAULT NULL COMMENT 'ของใช้ในครัวเรือน (ที่ใช้งานได้):: ไม่มีของใช้ดังกล่าว (1=yes, 0=no)',
`hhimg1` varchar(255) DEFAULT NULL COMMENT 'กรุณาถ่ายให้เห็น หลังคาและฝาผนังของที่พักอาศัยทั้งหลัง เก็บ 1 รูป',
`hhimg2` varchar(255) DEFAULT NULL COMMENT 'กรุณาถ่ายให้เห็น พื้นและบริเวณภายในของที่พักอาศัย เก็บ 1 รูป'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มข้อมูลครัวเรือน/ครอบครัว';



CREATE TABLE `hhrf` (
`hhrfid` int(2) NOT NULL COMMENT 'รหัสวัสดุที่ใช้ทำหลังคา',
`hhrfnme` varchar(50) NOT NULL COMMENT 'ชื่อวัสดุที่ใช้ทำหลังคา'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลวัสดุที่ใช้ทำหลังคา';



CREATE TABLE `hhtyp` (
`hhtypid` int(2) NOT NULL COMMENT 'รหัสการอยู่อาศัย',
`hhtypnme` varchar(50) NOT NULL COMMENT 'ชื่อการอยู่อาศัย'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลการอยู่อาศัย';



CREATE TABLE `hhwall` (
`hhwallid` int(2) NOT NULL COMMENT 'รหัสวัสดุที่ใช้ทำฝาบ้าน',
`hhwallnme` varchar(50) NOT NULL COMMENT 'ชื่อวัสดุที่ใช้ทำฝาบ้าน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลวัสดุที่ใช้ทำฝาบ้าน';



CREATE TABLE `hhwater` (
`hhwaterid` int(2) NOT NULL COMMENT 'รหัสแหล่งน้ำดื่ม',
`hhwaternme` varchar(50) NOT NULL COMMENT 'ชื่อแหล่งน้ำดื่ม'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลแหล่งน้ำดื่ม';



CREATE TABLE `htraining` (
`hhtrnid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการอบรม',
`htrndtestr` varchar(8) DEFAULT NULL COMMENT 'วันที่เริ่มอบรม เปิดไว้กรณีอบรมหลายวัน',
`htrndteend` varchar(8) DEFAULT NULL COMMENT 'วันที่อบรมเสร็จ',
`htrntit` varchar(50) DEFAULT NULL COMMENT 'เรื่องที่อบรม',
`prvid` varchar(2) DEFAULT NULL COMMENT 'จังหวัดที่อบรม',
`htrndetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดการอบรม'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มประวัติการอบรม';



CREATE TABLE `hwork` (
`hwrkid` bigint(20) NOT NULL COMMENT 'รหัสประวัติการประกอบอาชีพ',
`occid` int(2) DEFAULT NULL COMMENT 'รหัสอาชีพ',
`wrknme` varchar(30) DEFAULT NULL COMMENT 'ชื่อสถานประกอบการ',
`prvid` varchar(2) DEFAULT NULL COMMENT 'จังหวัดที่ทำงาน',
`wrkpos` varchar(30) DEFAULT NULL COMMENT 'ทำงานในตำแหน่ง',
`wrkstarty` int(4) DEFAULT NULL COMMENT 'ปีที่เริ่มประกอบอาชีพ',
`wrkperiody` int(2) DEFAULT NULL COMMENT 'ทำงานเป็นระยะเวลากี่ปีกี่เดือน หน่วย:: ปี',
`wrkperiodm` int(2) DEFAULT NULL COMMENT 'ทำงานเป็นระยะเวลากี่ปีกี่เดือน หน่วย:: เดือน',
`wrkendy` int(4) DEFAULT NULL COMMENT 'ปีที่ลาออก',
`wrkendreas` varchar(200) DEFAULT NULL COMMENT 'เหตุผลที่ลาออก'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลประวัติการประกอบอาชีพ';



CREATE TABLE `institute` (
`instid` int(2) NOT NULL COMMENT 'รหัสสถาบัน',
`insttypid` int(2) DEFAULT NULL COMMENT 'รหัสประเภทสถาบัน',
`instregister` int(1) DEFAULT NULL COMMENT 'จดทะเบียนหรือไม่ กรณีเป็นมูลนิธิ/สถานสงเคราะห์',
`instnme` varchar(100) DEFAULT NULL COMMENT 'ชื่อสถาบัน',
`prvid` varchar(2) DEFAULT NULL COMMENT 'จังหวัดที่ตั้งของสถาบัน',
`instname` varchar(50) DEFAULT NULL COMMENT 'ชื่อผู้รับผิดชอบสถาบัน',
`inssname` varchar(50) DEFAULT NULL COMMENT 'นามสกุลผู้รับผิดชอบสถาบัน',
`inststdno` int(5) DEFAULT NULL COMMENT 'สถาบันมีนักเรียนในความดูแล ณ ปัจจุบัน จำนวนกี่คน',
`instinc` decimal(8,2) DEFAULT NULL COMMENT 'สถาบันมีรายรับจากการสนับสนุน/รับบริจาคในรูปเงินและสิ่งของ คิดเป็นมูลค่ารวมทั้งสิ้น บาท/ปี',
`instlandrai` int(3) DEFAULT NULL COMMENT 'สถาบันมีที่ดินกี่ไร่กี่งาน',
`instlandngan` int(3) DEFAULT NULL COMMENT 'สถาบันมีที่ดินกี่ไร่กี่งาน',
`instbulding` int(3) DEFAULT NULL COMMENT 'สถาบันมีอาคารกี่หลัง',
`instvehicle` int(3) DEFAULT NULL COMMENT 'สถาบันมียานพาหนะที่ใช้งานได้กี่คัน',
`instimg1` varchar(255) DEFAULT NULL COMMENT 'กรุณาถ่ายให้เห็น หลังคาและฝาผนังของที่พักอาศัยทั้งหลัง เก็บ 1 รูป',
`instimg2` varchar(255) DEFAULT NULL COMMENT 'กรุณาถ่ายให้เห็น พื้นและบริเวณภายในของที่พักอาศัย เก็บ 1 รูป'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลสถาบัน กรณีเด็กพักในสถาบัน';



CREATE TABLE `inststay` (
`instid` int(2) NOT NULL COMMENT 'รหัสสถาบัน',
`persince` int(6) DEFAULT NULL COMMENT 'นักเรียนรายนี้อยู่กับสถาบันตั้งแต่เดือนปี (พ.ศ.)',
`helpmoney` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ให้เงินสด',
`helpobject` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ให้สิ่งของ',
`helpaccom` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ให้ที่พักอาศัย',
`helpfood` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ให้อาหาร',
`helpfare` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ให้การเดินทาง',
`helpedu` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ดูแลด้านการศึกษา',
`helphealth` int(1) DEFAULT NULL COMMENT 'สถาบันให้ความช่วยเหลือแก่นักเรียนรายนี้ด้วยวิธี:: ดูแลด้านสุขภาพ',
`helppayment` int(7) DEFAULT NULL COMMENT 'สถาบันมีรายจ่ายเฉลี่ยในการดูแลนักเรียนรายนี้ หน่วย:: บาท/คน/ปีการศึกษา',
`needscholar` int(1) DEFAULT NULL COMMENT 'สถาบันมีความประสงค์รับเงินอุดหนุนจาก กสศ. และสามารถปฏิบัติตามเงื่อนไขการรับทุนสำหรับนักเรียนรายนี้หรือไม่'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลการพักในสถาบัน';



CREATE TABLE `inststaytyp` (
`staytypid` int(2) NOT NULL COMMENT 'รหัสลักษณะที่พักอาศัยในสถาบัน',
`staytypnme` varchar(50) NOT NULL COMMENT 'ชื่อลักษณะที่พักอาศัยในสถาบัน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลลักษณะที่พักอาศัยในสถาบัน';



CREATE TABLE `insttyp` (
`insttypid` int(2) NOT NULL COMMENT 'รหัสประเภทสถาบัน',
`insttypnme` varchar(50) NOT NULL COMMENT 'ชื่อประเภทสถาบัน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลประเภทหน่วยงาน/สถาบัน';



CREATE TABLE `livew` (
`livewid` int(2) NOT NULL COMMENT 'รหัสนักเรียนอาศัยอยู่กับ',
`livewnme` varchar(50) NOT NULL COMMENT 'ชื่อนักเรียนอาศัยอยู่กับ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลนักเรียนอาศัยอยู่กับ';



CREATE TABLE `marstt` (
`marid` int(1) NOT NULL COMMENT 'รหัสสถานะการแต่งงาน',
`marnme` varchar(50) NOT NULL COMMENT 'ชื่อสถานะการแต่งงาน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลสถานะการแต่งงาน';



CREATE TABLE `member` (
`eduid` int(1) DEFAULT NULL COMMENT 'รหัสระดับการศึกษาสูงสุด',
`marid` int(1) DEFAULT NULL COMMENT 'รหัสสถานะการแต่งงาน',
`chinum` int(2) DEFAULT NULL COMMENT 'จำนวนบุตร',
`occid` int(2) DEFAULT NULL COMMENT 'รหัสอาชีพ',
`occspec` varchar(50) DEFAULT NULL COMMENT 'ระบุอาชีพแบบเฉพาะเจาะ',
`salary` int(10) DEFAULT NULL COMMENT 'รายได้จากค่าจ้าง/เงินเดือน ต่อเดือน',
`incagri` int(10) DEFAULT NULL COMMENT 'รายได้จากเกษตรกรรม (หลังหักค่าใช้จ่าย) ต่อเดือน',
`incbusi` int(10) DEFAULT NULL COMMENT 'รายได้จากธุรกิจส่วนตัว (หลังหักค่าใช้จ่าย) ต่อเดือน',
`incwelf` int(10) DEFAULT NULL COMMENT 'รายได้สวัสดิการจากรัฐ (บำนาญ, เบี้ยผู้สูงอายุ, เงินอุดหนุนอื่น ๆ จากรัฐบาล) ต่อเดือน',
`incoth` int(10) DEFAULT NULL COMMENT 'รายได้จากแหล่งอื่นๆ (เงินโอนครอบครัว, ค่าเช่าและอื่นๆ) ต่อเดือน',
`inctotal` int(10) DEFAULT NULL COMMENT 'รายได้รวมเฉลี่ยต่อเดือน',
`welfare` int(1) DEFAULT NULL COMMENT 'ได้สวัสดิการแห่งรัฐ(ทะเบียนคนจน)/โครงการคนละครึ่ง/เราชนะ/ม.33เรารักกัน',
`disable` int(1) DEFAULT NULL COMMENT 'มีความพิการ ทางร่างกาย/ สติปัญญา/มีโรคเรื้อรัง'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลผู้ปกครอง/สมาชิกในบ้านเพิ่มเติม';



CREATE TABLE `occ` (
`occid` int(2) UNSIGNED NOT NULL COMMENT 'รหัสอาชีพ',
`occnme` varchar(50) NOT NULL COMMENT 'ชื่ออาชีพ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='Table to store occupations';



CREATE TABLE `perrel` (
`relid` int(1) DEFAULT NULL COMMENT 'รหัสความสัมพันธ์',
`reloth` varchar(50) DEFAULT NULL COMMENT 'ระบุกรณีเป็นญาติหรืออื่น ๆ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลความสัมพันธ์ระหว่างบุคคล';



CREATE TABLE `person` (
`perid` bigint(20) NOT NULL COMMENT 'รหัสบุคคล',
`pid` varchar(13) DEFAULT NULL COMMENT 'เลขบัตรประชาชน',
`titid` int(2) DEFAULT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
`name` varchar(50) DEFAULT NULL COMMENT 'ชื่อ',
`sname` varchar(50) DEFAULT NULL COMMENT 'สกุล',
`genid` int(1) DEFAULT NULL COMMENT 'รหัสเพศ',
`religid` int(2) DEFAULT NULL COMMENT 'รหัสศาสนา',
`religoth` varchar(30) DEFAULT NULL COMMENT 'กรณีศาสนาอื่น ๆ',
`brtdte` varchar(8) DEFAULT NULL COMMENT 'ปีเดือนวันเกิด',
`age` int(1) DEFAULT NULL COMMENT 'อายุ',
`adr` varchar(20) DEFAULT NULL COMMENT 'ที่อยู่ปัจจุบัน บ้านเลขที่',
`soi` varchar(30) DEFAULT NULL COMMENT 'ถนน ซอย',
`vllid` varchar(2) DEFAULT NULL COMMENT 'หมู่ที่',
`plcid` varchar(6) DEFAULT NULL COMMENT 'จังหวัดอำเภอตำบล',
`postcode` int(5) DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
`pertel` varchar(30) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
`hholdid` bigint(2) DEFAULT NULL COMMENT 'รหัสครัวเรือน'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลบุคคล';



CREATE TABLE `plc` (
`plcid` varchar(6) NOT NULL COMMENT 'รหัสพื้นที่',
`plcnme` varchar(100) NOT NULL COMMENT 'ชื่อจังหวัดอำเภอตำบล'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลพื้นที่ จังหวัดอำเภอตำบลของจังหวัดปัตตานี';



CREATE TABLE `prv` (
`prvid` varchar(2) NOT NULL COMMENT 'รหัสจังหวัด',
`prvnme` varchar(50) NOT NULL COMMENT 'ชื่อจังหวัด'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลจังหวัดของประเทศไทย';



CREATE TABLE `relfam` (
`relid` int(2) NOT NULL COMMENT 'รหัสความสัมพันธ์',
`relnme` varchar(50) NOT NULL COMMENT 'ชื่อความสัมพันธ์'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลความสัมพันธ์ระหว่างบุคคล';



CREATE TABLE `relig` (
`religid` int(2) UNSIGNED NOT NULL COMMENT 'รหัสศาสนา',
`relignme` varchar(50) NOT NULL COMMENT 'ชื่อศาสนา'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='Table to store religions';



CREATE TABLE `schmethod` (
`schmethid` int(2) NOT NULL COMMENT 'รหัสวิธีเดินทางหลัก',
`schmethnme` varchar(50) NOT NULL COMMENT 'ชื่อวิธีเดินทางหลัก'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลวิธีเดินทางหลักไปโรงเรียน';



CREATE TABLE `staff` (
`staffid` int(4) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
`pid` varchar(13) DEFAULT NULL COMMENT 'เลขบัตรประชาชน',
`titid` int(2) DEFAULT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
`staffnme` varchar(30) DEFAULT NULL COMMENT 'ชื่อ',
`staffsnme` varchar(30) DEFAULT NULL COMMENT 'นามสกุล',
`stafftell` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
`staffemail` varchar(50) DEFAULT NULL COMMENT 'อีเมล์',
`stafforg` varchar(50) DEFAULT NULL COMMENT 'หน่วยงานที่สังกัด',
`plcid` varchar(6) DEFAULT NULL COMMENT 'จังหวัดอำเภอตำบล หน่วยงานที่สังกัด',
`staffposid` int(2) DEFAULT NULL COMMENT 'รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้',
`staffprioid` int(2) DEFAULT NULL COMMENT 'รหัสสิทธิการเข้าถึงข้อมูล',
`staffusername` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้ใช้งาน',
`staffpassword` varchar(60) DEFAULT NULL COMMENT 'รหัสผ่าน',
`profile_photo` varchar(255) DEFAULT NULL COMMENT 'รูปภาพประจำตัว',
`status` varchar(1) DEFAULT NULL COMMENT 'สถานะผู้ใช้งาน',
`crated_at` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
`updated_at` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='แฟ้มข้อมูลผู้ใช้งานโปรแกรม';



CREATE TABLE `staffpos` (
`staffposid` int(2) NOT NULL COMMENT 'รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้ เช่น ผู้ดูแลระบบ หัวหน้าโครงการ เจ้าหน้าที่ภาคสนาม เป็นต้น',
`staffposnme` varchar(50) NOT NULL COMMENT 'รหัสตำแหน่ง/ภาระหน้าที่สำหรับระบบนี้ เช่น ผู้ดูแลระบบ หัวหน้าโครงการ เจ้าหน้าที่ภาคสนาม เป็นต้น'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลตำแหน่ง/ภาระหน้าที่สำหรับระบบ';



CREATE TABLE `staffprio` (
`staffprioid` int(2) NOT NULL COMMENT 'รหัสสิทธิการเข้าถึงข้อมูล',
`staffprionme` varchar(50) NOT NULL COMMENT 'ชื่อสิทธิการเข้าถึงข้อมูล'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลสิทธิการเข้าถึงข้อมูล';



CREATE TABLE `titname` (
`titid` int(2) UNSIGNED NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
`titnme` varchar(20) NOT NULL COMMENT 'ชื่อคำนำหน้าชื่อ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลคำนำหน้าชื่อ';



CREATE TABLE `vll` (
`vllid` varchar(2) NOT NULL COMMENT 'รหัสหมู่ที่',
`vllnme` varchar(100) NOT NULL COMMENT 'ชื่อหมู่บ้าน',
`plcid` varchar(6) NOT NULL COMMENT 'รหัสพื้นที่'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลหมู่บ้านในจังหวัดปัตตานี';


ALTER TABLE `activity`
ADD PRIMARY KEY (`actid`);

ALTER TABLE `acttyp`
ADD PRIMARY KEY (`acttypid`);

ALTER TABLE `agrland`
ADD PRIMARY KEY (`agrlandid`);

ALTER TABLE `child`
ADD PRIMARY KEY (`perid`);

ALTER TABLE `const_plcnmegen`
ADD PRIMARY KEY (`prvidgen`,`ampidgen`,`tmbidgen`,`plcidgen`),
ADD KEY `plc_index` (`plcidgen`);

ALTER TABLE `const_vllnmegen`
ADD PRIMARY KEY (`prvidgen`,`ampidgen`,`tmbidgen`,`vllidgen`);

ALTER TABLE `dispform`
ADD PRIMARY KEY (`dispfrmid`);

ALTER TABLE `disptyp`
ADD PRIMARY KEY (`disptypid`);

ALTER TABLE `edulev`
ADD PRIMARY KEY (`eduid`),
ADD UNIQUE KEY `edulevid_UNIQUE` (`eduid`);

ALTER TABLE `famstt`
ADD PRIMARY KEY (`famsttid`);

ALTER TABLE `gender`
ADD PRIMARY KEY (`genid`);

ALTER TABLE `hedu`
ADD PRIMARY KEY (`heduid`);

ALTER TABLE `hfolowup`
ADD PRIMARY KEY (`hflwid`);

ALTER TABLE `hhdepon`
ADD PRIMARY KEY (`hhdeponid`);

ALTER TABLE `hhelect`
ADD PRIMARY KEY (`hhelectid`);

ALTER TABLE `hhelpedu`
ADD PRIMARY KEY (`hheduid`);

ALTER TABLE `hhelpjob`
ADD PRIMARY KEY (`hhjobid`);

ALTER TABLE `hhflr`
ADD PRIMARY KEY (`hhflrid`);

ALTER TABLE `hhold`
ADD PRIMARY KEY (`hholdid`);

ALTER TABLE `hhrf`
ADD PRIMARY KEY (`hhrfid`);

ALTER TABLE `hhtyp`
ADD PRIMARY KEY (`hhtypid`);

ALTER TABLE `hhwall`
ADD PRIMARY KEY (`hhwallid`);

ALTER TABLE `hhwater`
ADD PRIMARY KEY (`hhwaterid`);

ALTER TABLE `htraining`
ADD PRIMARY KEY (`hhtrnid`);

ALTER TABLE `hwork`
ADD PRIMARY KEY (`hwrkid`);

ALTER TABLE `institute`
ADD PRIMARY KEY (`instid`);

ALTER TABLE `inststaytyp`
ADD PRIMARY KEY (`staytypid`);

ALTER TABLE `insttyp`
ADD PRIMARY KEY (`insttypid`);

ALTER TABLE `livew`
ADD PRIMARY KEY (`livewid`);

ALTER TABLE `marstt`
ADD PRIMARY KEY (`marid`);

ALTER TABLE `member`
ADD PRIMARY KEY (`perid`);

ALTER TABLE `occ`
ADD PRIMARY KEY (`occid`);

ALTER TABLE `perrel`
ADD PRIMARY KEY (`intperid`);

ALTER TABLE `person`
ADD PRIMARY KEY (`perid`);

ALTER TABLE `plc`
ADD PRIMARY KEY (`plcid`);

ALTER TABLE `prv`
ADD PRIMARY KEY (`prvid`);

ALTER TABLE `relfam`
ADD PRIMARY KEY (`relid`);

ALTER TABLE `relig`
ADD PRIMARY KEY (`religid`);

ALTER TABLE `schmethod`
ADD PRIMARY KEY (`schmethid`);

ALTER TABLE `staff`
ADD PRIMARY KEY (`staffid`);

ALTER TABLE `staffpos`
ADD PRIMARY KEY (`staffposid`);

ALTER TABLE `staffprio`
ADD PRIMARY KEY (`staffprioid`);

ALTER TABLE `titname`
ADD PRIMARY KEY (`titid`);

ALTER TABLE `vll`
ADD PRIMARY KEY (`vllid`),
ADD KEY `FK_vll_plc` (`plcid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


















































































































































































































































































































































