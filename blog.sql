-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2019 at 12:08 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(19, 'Programming', 'programming'),
(20, 'Python ', 'python '),
(21, 'Java', 'java'),
(22, 'PHP', 'php'),
(23, 'Swift', 'swift');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `date` varchar(100) NOT NULL,
  `comment_status` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `date`, `comment_status`, `post_id`) VALUES
(34, 'sanket', 'sanketkhote99@gmail.com', 'Nice Post!!!', '15-Feb-2019 11:44 PM', 'approve', 31),
(35, 'Sanket Khote', 'sanketkhote99@gmail.com', 'How To use Laravel !!!', '04-Mar-2019 07:40 PM', 'approve', 33),
(36, 'sanket', 'sanketkhote99@gmail.com', 'What we can do with Python', '04-Mar-2019 07:41 PM', 'pending', 29),
(37, 'Niks', 'niks@gmail.com', 'Scope of Ruby in 2019', '04-Mar-2019 07:41 PM', 'approve', 29);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `name`, `email`, `url`, `message`, `role`, `date`) VALUES
(1, 'sanket', 'sanketkhote99@gmail.com', '', 'How to send email', 'contact', '19-Feb-2019 09:24 PM'),
(6, 'sanket', 'sanketkhote99@gmail.com', '', 'Got New subscription', 'subscribe', '22-Feb-2019 09:33 PM'),
(7, 'Sanket Khote', 'sanketkhote99@gmail.com', 'http://www.sanket.com', 'This is Awesome Website\r\nI love it', 'contact', '22-Feb-2019 09:42 PM'),
(8, 'Sanket Khote', 'sanketkhote99@gmail.com', 'http://www.sanket.com', 'Nice Blog !!!!!!!!', 'contact', '04-Mar-2019 11:05 PM');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'Tech Blog'),
(2, 'site_discp', 'Blog For Newbies'),
(3, 'post_per_page', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `img`, `link`, `status`) VALUES
(1, 'pl.jpg', 'https://www.shoutmeloud.com/about', 'ad'),
(2, 'downlod.jpg', '', ''),
(3, 'ad.jpg', 'https://sitebeginner.com/code/phpemailform/', 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `post` longtext NOT NULL,
  `sampleText` varchar(200) NOT NULL,
  `post_status` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `post_view` int(11) NOT NULL,
  `unique_visitor` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `category`, `author`, `img`, `post`, `sampleText`, `post_status`, `type`, `comment_count`, `post_view`, `unique_visitor`, `category_id`) VALUES
(29, '15-Feb-2019 10:56 PM', '5 Best Programming Languages for Kids', 'Programming', 'sanket', '09-05-2017-why-coding-infographic-blog.png', '<p>The rate at which children handle gadgets in this technology savvy era is quite interesting. The fact they are able to easily operate the gadgets, run programs on it easily shows that they are intrigued by it. We all at a point have come across children who not only enjoy the games or other softwares but have shown interest in asking questions on how the softwares are programmed. One of the best ways of keeping them fascinated is by teaching them programming languages, i.e., coding or by making them write a mini research paper to spur their interest in coding</p>\r\n<p>Computer software, applications and websites applications are developed by using programming language commonly referred to as &lsquo;coding&rsquo;.&nbsp;<a href=\"https://www.lifewire.com/kids-programming-languages-4125938\" target=\"_blank\" rel=\"noopener\">Coding</a>&nbsp;is basically the process of giving instructions to our computer to act in certain ways or perform certain tasks. Coding is important for children because it allows them to develop different skills such as problem-solving skill(the breaking down of instructions to the lowest opens up their analytical and logical mind), it also increases their creativity (by opening up their imaginative mind, allows them to creatively improve on other apps they find lacking in a particular aspect, allows them to even create their own app to solve a problem), allows them intelligently have fun rather than wasting time on irrelevances and besides coding is the new cool lucrative means of income.</p>\r\n<p>When it comes to technology, everything is codes and programming. Imagine if you searched for &ldquo;<a href=\"https://edubirdie.com/research-papers-writing-services\" target=\"_blank\" rel=\"noopener\">who can write my research paper for me</a>&rdquo; on the internet, what gives you your desired result is a function of coding. There are a lot of programming languages that children can learn how to code from at the basic and intermediate level.</p>\r\n<h2>5 Best Programming Languages for Kids</h2>\r\n<h3>1. Scratch</h3>\r\n<p>Scratch is a programming language built by MIT&rsquo;s Lifelong Kindergarten Lab.&nbsp; Scratch is a free programming language that can be used without an online connection for kids who are mostly interested in animations, games, music or arts. It has an interactive online community where kids can connect with other kids and share their developed applications.&nbsp; It uses a building-block visual interface.</p>\r\n<p>Scratch has an interactive and user-friendly interface that naturally attracts children. It also allows a child to freely express his or her creativity to design games or animations from scratch as the name implies. Scratch is suggested for kids within the age bracket of 6-15 years of age.&nbsp; It has a tutorial guide for beginners.</p>\r\n<h3>2. Python</h3>\r\n<p>Python is regarded as the easiest of&nbsp;<a href=\"https://www.idtech.com/blog/choose-best-programming-language-your-child.\" target=\"_blank\" rel=\"noopener\">programming languages&nbsp;</a>to learn.&nbsp; This is partly because of its basic composition and attention on whitespace. It is said to be named after the comedy series Monthly Python. It is recommended for all age brackets. It is the first stepping stone to increase your child&rsquo;s interest in coding.&nbsp; To show its usefulness, even Google and Disney make use of it. With python, coding can be used to create video games, numeric computing tasks, web fireworks, etc.</p>\r\n<p>Python delivers like regular language. It rarely requires the use of comments because it functions with Basic English language. Python programming language also has a section for its library where it allows children to further code beyond the basic.</p>\r\n<p>Python teaches children the patience and analytical skill to overcome complexities which would come from one of their strengths later in life.</p>\r\n<h3>3. Ruby</h3>\r\n<p>Ruby has the most decipherable composition for beginners. Ruby is expressive, intuitive, simple and powerful. Ruby teaches the child to freely express his or herself because it allows them to choose from different methods to solve a problem. Ruby uses blocks and first-class objects. Ruby also has a standard library and an interactive shell. Ruby is concise, well documented (extensive API docs) has an easy to understand the language that does not require extra explanations. With Ruby, the kid gets familiar with programming concepts like variables, loops, object-oriented programming, etc.</p>\r\n<h3>4. Lua</h3>\r\n<p>Lua is a free, powerful, fast and user-friendly programming language that is easily understood by kids. Lua is popularly used as a scripting language platform by game developers Because of its speed and lightness. Lua is perfect for children who are into game developing at any stage including animations. Lua engages its user by introducing simple concepts while retaining its legibility, clarity, and productivity.&nbsp; Lua also removes the syntax problem that makes coding difficult for kids.</p>\r\n<h3>5. Blockly</h3>\r\n<p>Blockly is a visual block programming language built on other existing programming languages to help children become experts at coding. Blockly is essentially developed for kids 8 years and above who are learning how to code within the confines of their homes or at school.</p>\r\n<p>Blokly has a &ldquo;<a href=\"https://codakid.com/kids-coding-languages/\" target=\"_blank\" rel=\"noopener\">JavaScript library&nbsp;</a>&rdquo; feature, a&nbsp; specific UI bearing a resemblance to multi-colored and multi-shaped blocks holding and a toolbox holding the block and bin to write codes in. In operating Blockly, kids remove the blocks from the toolbox one by one and arrange them structurally until the quest is solved. Upon completion, Blockly runs a check up to assess the coding done to check for its errors.</p>', 'Computer software, applications and websites applications are developed by using programming language commonly referred to as â€˜codingâ€™.', 'publish', 'post', 2, 1, 0, 19),
(30, '15-Feb-2019 10:58 PM', 'Introduction to Python Programming', 'Python ', 'sanket', '', '<p>Python is a General-Purpose Programming Language or rather a Scripting Language. It was developed in 1990s by a person named Guido Van Rossum.</p>\r\n<h2>Features of Python</h2>\r\n<p>1. Cross-Compiled i.e., Platform Independent or Portable<br />2. Interpreted<br />3. High-level Scripting Language<br />4. Open Source<br />5. Supports Object Oriented Features</p>\r\n<p>Python is an interpreted and a cross-compiled programming language. It is actually a Scripting Language rather than a Programming Language. A Scripting language is basically used in combination with HTML code usually for a Website Development. Python code is comparatively very less than that of Java, C or C++. Python is one of the few languages which supports Procedural Programming features and Object Oriented Programming in a single program.</p>\r\n<p>&nbsp;</p>\r\n<h2>Applications of Python</h2>\r\n<p>1. Web Application Development and Web Frameworks such as DJango and Pyramid.<br />2. Game Development<br />3. Desktop Based Applications<br />4. Micro Frameworks such as Bottle and Flask</p>\r\n<p>&nbsp;</p>\r\n<p>Python is a Free and an Open-Source Language. It is one of the most demanded languages all over the world as of now and has a huge career scope. So, you better learn it with us.</p>\r\n<p>Python is available in Windows Operating Systems, Linux Versions such as Ubuntu, OpenSuse, etc. Python can also be worked upon in Mac OS.</p>\r\n<p>&nbsp;</p>\r\n<h2>Installing Python</h2>\r\n<p>The following are the ways to install Python on different platforms.</p>\r\n<p>&nbsp;</p>\r\n<h3>Windows</h3>\r\n<p>You can either use an IDE for Python programming or use a Command Line Tool. Python&rsquo;s latest version is Python 3.4.3. Visit the following link and select the version to download it.&nbsp;<a href=\"https://www.python.org/downloads/\" target=\"_blank\" rel=\"nofollow noopener\">https://www.python.org/downloads/</a></p>\r\n<p>You also get an Integrated Development Environment (IDE) available for Python programming. One of the best IDEs available in the market is JetBrains PyCharm Edition. It provides an Editor, in-built Interpreter and many other features such as Web Development, Django Frameworks Development. It is a freeware or a Free Edition. You can download the Community Edition (Free) using the following link.<br /><a href=\"https://www.jetbrains.com/pycharm/download/\" target=\"_blank\" rel=\"nofollow noopener\">https://www.jetbrains.com/pycharm/download/</a></p>\r\n<p>&nbsp;</p>\r\n<h3>Linux</h3>\r\n<p>Linux, specifically Ubuntu Distribution comes pre-installed with Python Interpreter. So, it has a pre-installed Python programming Command Line Tool. In order to check whether your system has Python installed on it, open the Terminal and type below command.</p>\r\n<p><em>python &ndash;version</em></p>\r\n<p>This command will display the version of Python installed on your machine.</p>\r\n<p>However, if you need an Integrated Development Environment (IDE) for Python, you can download the JetBrains PyCharm package from the following link and install it. To download the PyCharm Free Edition, visit the following link and select Linux OS.<br />&nbsp;<a href=\"https://www.jetbrains.com/pycharm/download/\" target=\"_blank\" rel=\"nofollow noopener\">https://www.jetbrains.com/pycharm/download/</a></p>\r\n<p>&nbsp;</p>\r\n<p>Follow the steps below to Install Python in Ubuntu (Linux)</p>\r\n<p>1. Copy the file with .tar.gz extension into a location folder. It should be an Empty Directory. This folder will be the location where the Python software will be installed.</p>\r\n<p>2. Unpack (or Extract) the file using the following command from the Ubuntu Terminal.<br /><em>tar xfz filename.tar.gz</em></p>\r\n<p>3. Now, execute the PyCharm.sh from the Bin Directory.</p>\r\n<p>&nbsp;</p>\r\n<h3><strong>Mac OS X</strong></h3>\r\n<p>To use Python in Mac OS, you need an Integrated Development Environment such as JetBrains PyCharm Community Edition which is a Freeware. You can also opt for its Professional Edition which is free for 30 Days Evaluation Period. To download it for Mac OS, visit the following link and select your Operating System.<br /><a href=\"https://www.jetbrains.com/pycharm/download/\" target=\"_blank\" rel=\"nofollow noopener\">https://www.jetbrains.com/pycharm/download/</a></p>\r\n<p>Download the PyCharm file and Mount it as another disk in your system. Now copy the PyCharm file into your Applications Folder and you&rsquo;re ready to run Python.</p>', 'Python is a General-Purpose Programming Language or rather a Scripting Language. It was developed in 1990s by a person named Guido Van Rossum.', 'publish', 'post', 1, 3, 0, 20),
(31, '15-Feb-2019 11:09 PM', '10 Java Coding Tips Every Programmer Should Know', 'Java', 'sanket', 'cover.png', '<p class=\"p1\"><span class=\"s1\">When you talk about Object Oriented Programming, the best and the most apt example that comes to the mind is Java. Developed by Sun Microsystems, Java leads the way in terms of cross platform programming language and developing application software. The reason Java has gained such a large fan base and unprecedented popularity is because the language deploys a very easy and efficient approach to perform various programming tasks and aid the developers.</span></p>\r\n<p>&nbsp;</p>\r\n<p class=\"p1\"><span class=\"s1\">Its simplicity can sometimes be a distraction and the highly experienced Java developers have always aimed a notch higher and have tried to explore the different possibilities that the language offers. Being a good Java developer is always within touching distance of any computer programming enthusiast, however; it is standing amongst the very bests that matters.&nbsp;</span></p>\r\n<p class=\"p1\"><span class=\"s1\">Below are some tips that might help you grow as a Java developer and gain more knowledge about the language.&nbsp;</span></p>\r\n<h3 class=\"p1\"><span class=\"s1\"><strong>1. Get the basics right</strong></span></h3>\r\n<p class=\"p1\"><span class=\"s1\">As Java offers so many features and options to the developers, people are sometimes lured into learning too many things in too little time. As a result of this, they get &lsquo;bits and pieces&rsquo; knowledge of a few options that Java offers, but their basics hang on a loose thread. Trust me when I say this, Java is one programming language which is easy if you have paid attention to the simple basics, however; it can be frustrating if you get greedy and try to take the shorter route forward.</span></p>\r\n<h3 class=\"p1\"><span class=\"s1\"><strong>2. Don&rsquo;t just read&nbsp;</strong></span></h3>\r\n<p class=\"p1\"><span class=\"s1\">Well, if your sole purpose of learning Java is to clear the exam you have the next day, go ahead and mug up all the things that you can and you might just get the passing marks. However; if you are really serious about learning Java and getting better at it, the best way to do it is not by reading, but by implementing. Gain knowledge and then execute what you have learnt, in the form of code. You can never learn Java if you are not willing to get your hands dirty.</span></p>\r\n<h3 class=\"p1\"><span class=\"s1\"><strong>3. Understand your code and algorithm</strong></span></h3>\r\n<p class=\"p1\"><span class=\"s1\">Even if you are writing a simple code having a &lsquo;if else&rsquo; statement, as a beginner, start by realizing the code on a piece of paper. The algorithm and the whole compiler process will look so meaningful once you understand the idea behind the code. Even for experts, the best way to solve a complex problem or to formulate an algorithm to solve a Java program is to break the problem into sub-parts and then try to devise a solution for each sub part. When you start getting the solutions right, you will get the confidence to work more.</span></p>\r\n<h3 class=\"p1\"><span class=\"s1\"><strong>4. Do not forget to allocate memory&nbsp;</strong></span></h3>\r\n<p class=\"p1\"><span class=\"s1\">This tip is particularly useful for those who switch from C, C++ to Java. The memory allocation in Java using the &lsquo;new&rsquo; keyword is a necessity as Java is a dynamic programming language. C, C++ does not explicitly have this feature, therefore you must take care while handling array and object declaration in Java. Not using the &lsquo;new&rsquo; keyword will show a null pointer exception in the code.</span></p>\r\n<p class=\"p1\"><span class=\"s1\">Eg:</span></p>\r\n<div>\r\n<div id=\"highlighter_21597\" class=\"syntaxhighlighter codeblock java\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"gutter\">\r\n<div class=\"line number1 index0 alt2\">1</div>\r\n</td>\r\n<td class=\"code\">\r\n<div class=\"container\">\r\n<div class=\"line number1 index0 alt2\"><code class=\"java keyword\">int</code> <code class=\"java plain\">array = </code><code class=\"java keyword\">new</code> <code class=\"java keyword\">int</code> <code class=\"java plain\">[</code><code class=\"java value\">5</code><code class=\"java plain\">];</code></div>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n<p class=\"p1\"><span class=\"s1\">Note the difference in array declaration in Java and C or C++.</span></p>\r\n<h3 class=\"p1\"><span class=\"s1\"><strong>5. Avoid creating useless objects</strong></span></h3>\r\n<p class=\"p1\"><span class=\"s1\">When you create an object in Java, you use up memory and processor speed from the system. Since object creation is incomplete without allocating memory to it, it is better to keep the object requirements under check and not create unwanted objects in the code.</span></p>\r\n<p class=\"p1\"><span class=\"s1\">Eg:</span></p>\r\n<div>\r\n<div id=\"highlighter_498494\" class=\"syntaxhighlighter codeblock java\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"gutter\">\r\n<div class=\"line number1 index0 alt2\">1</div>\r\n<div class=\"line number2 index1 alt1\">2</div>\r\n<div class=\"line number3 index2 alt2\">3</div>\r\n<div class=\"line number4 index3 alt1\">4</div>\r\n<div class=\"line number5 index4 alt2\">5</div>\r\n<div class=\"line number6 index5 alt1\">6</div>\r\n<div class=\"line number7 index6 alt2\">7</div>\r\n<div class=\"line number8 index7 alt1\">8</div>\r\n</td>\r\n<td class=\"code\">\r\n<div class=\"container\">\r\n<div class=\"line number1 index0 alt2\"><code class=\"java keyword\">public</code> <code class=\"java keyword\">class</code> <code class=\"java plain\">vehicles {</code></div>\r\n<div class=\"line number2 index1 alt1\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java keyword\">public</code> <code class=\"java plain\">List getvehicles(){</code></div>\r\n<div class=\"line number3 index2 alt2\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java keyword\">if</code><code class=\"java plain\">(</code><code class=\"java keyword\">null</code> <code class=\"java plain\">== vehicles){&nbsp;</code><code class=\"java comments\">// this ensures that the object is initialised only when its required</code></div>\r\n<div class=\"line number4 index3 alt1\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java plain\">countries = </code><code class=\"java keyword\">new</code> <code class=\"java plain\">ArrayList();</code></div>\r\n<div class=\"line number5 index4 alt2\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java plain\">}</code></div>\r\n<div class=\"line number6 index5 alt1\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java keyword\">return</code> <code class=\"java plain\">vehicles;</code></div>\r\n<div class=\"line number7 index6 alt2\"><code class=\"java spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"java plain\">}</code></div>\r\n<div class=\"line number8 index7 alt1\"><code class=\"java plain\">}</code></div>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n<h3 class=\"p2\"><span class=\"s1\"><strong>6. Interface is better than Abstract class</strong></span></h3>\r\n<p class=\"p2\"><span class=\"s1\">There is no multiple inheritance in Java, and this will be spoon fed to you so many times while learning the language that you will probably never forget it for the rest of your life. However; the tip here in not to remember that there is no multiple inheritance in Java, but the fact that interface will come in handy if you want to implement something like multiple inheritance without using the extends keyword. Remember, in Java, when nothing goes your way, you will always have interface by your side. Abstract class does not always give programmers the liberty of having a variety of methods to work with, however; interface only have abstract methods therefore is does the job of abstract classes and has other advantages as well.&nbsp;</span></p>\r\n<h3 class=\"p2\"><span class=\"s1\"><strong>7. Standard library is a bliss</strong></span></h3>\r\n<p class=\"p2\"><span class=\"s1\">The biggest advantage that Java has over its predecessors, from a programming point of view, is probably its rich set of standard library methods.&nbsp; Using Java&rsquo;s standard library makes the job of a programmer easy, more efficient and gives a well organised flow to the code. Further, operations can be performed easily on the methods specified in the library.&nbsp;</span></p>\r\n<h3 class=\"p2\"><span class=\"s1\"><strong>8. Prefer Primitive classes over Wrapper Class</strong></span></h3>\r\n<p class=\"p2\"><span class=\"s1\">Wrapper classes are no doubt, of great utility, but they are often slower than primitive classes. Primitive class only has values while the wrapper class stores information about the entire class.&nbsp; Further, since wrapper classes often deal with object values, comparing them like the primitive classes does not give desired results as it ends up comparing objects instead of values stored in it.</span></p>\r\n<p class=\"p2\"><span class=\"s1\">Eg:</span></p>\r\n<div>\r\n<div id=\"highlighter_425740\" class=\"syntaxhighlighter codeblock java\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"gutter\">\r\n<div class=\"line number1 index0 alt2\">1</div>\r\n<div class=\"line number2 index1 alt1\">2</div>\r\n<div class=\"line number3 index2 alt2\">3</div>\r\n<div class=\"line number4 index3 alt1\">4</div>\r\n<div class=\"line number5 index4 alt2\">5</div>\r\n<div class=\"line number6 index5 alt1\">6</div>\r\n</td>\r\n<td class=\"code\">\r\n<div class=\"container\">\r\n<div class=\"line number1 index0 alt2\"><code class=\"java keyword\">int</code> <code class=\"java plain\">num_1 = </code><code class=\"java value\">10</code><code class=\"java plain\">;</code></div>\r\n<div class=\"line number2 index1 alt1\"><code class=\"java keyword\">int</code> <code class=\"java plain\">num_2 = </code><code class=\"java value\">10</code><code class=\"java plain\">;</code></div>\r\n<div class=\"line number3 index2 alt2\"><code class=\"java plain\">Integer wrapnum_1 = </code><code class=\"java keyword\">new</code> <code class=\"java plain\">Integer(</code><code class=\"java value\">10</code><code class=\"java plain\">);</code></div>\r\n<div class=\"line number4 index3 alt1\"><code class=\"java plain\">Integer wrapnum_2 = </code><code class=\"java keyword\">new</code> <code class=\"java plain\">Integer(</code><code class=\"java value\">10</code><code class=\"java plain\">);</code></div>\r\n<div class=\"line number5 index4 alt2\"><code class=\"java plain\">System.out.println(num_1 == num_2);</code></div>\r\n<div class=\"line number6 index5 alt1\"><code class=\"java plain\">System.out.println(wrapnum_1 == wrapnum_2);</code></div>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n<p class=\"p2\"><span class=\"s1\">Note: In the above example, the second print statement will not display true because wrapper class objects are getting compared and not their values.</span></p>\r\n<h3 class=\"p2\"><span class=\"s1\"><strong>9. Dealing with strings</strong></span></h3>\r\n<p class=\"p2\"><span class=\"s1\">Since Object oriented programming classifies String as a class, a simple concatenation of two strings might result into the creation of a new string object in Java which eventually affects the memory and speed of the system. It is always better to instantiate a string object directly, without using the constructor for this purpose.</span></p>\r\n<p class=\"p2\"><span class=\"s1\">Eg:</span></p>\r\n<div>\r\n<div id=\"highlighter_270724\" class=\"syntaxhighlighter codeblock java\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"gutter\">\r\n<div class=\"line number1 index0 alt2\">1</div>\r\n<div class=\"line number2 index1 alt1\">2</div>\r\n</td>\r\n<td class=\"code\">\r\n<div class=\"container\">\r\n<div class=\"line number1 index0 alt2\"><code class=\"java plain\">String slow = </code><code class=\"java keyword\">new</code> <code class=\"java plain\">String (</code><code class=\"java string\">\"This string is making the system slow\"</code><code class=\"java plain\">); </code><code class=\"java comments\">//slow instantiation</code></div>\r\n<div class=\"line number2 index1 alt1\"><code class=\"java plain\">String fast = </code><code class=\"java string\">\"This string is better\"</code><code class=\"java plain\">; </code><code class=\"java comments\">//fast instantiation</code></div>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n<h3 class=\"p2\"><span class=\"s1\"><strong>10. Code, Code, Code</strong></span></h3>\r\n<p class=\"p2\"><span class=\"s1\">There is so much to learn about Java that you just cannot get over with this programming language and it keeps getting more interesting and amusing, however; it is important to maintain the interest within to learn and the hunger to get better. A programming language like Java can be learnt on our own and with great success, but the only thing that is required is continuous learning and coding to test what you have learnt.&nbsp; Java is a lot like playing a sport; the more you sweat in the practice, less you bleed in the match.</span></p>', 'When you talk about Object Oriented Programming, the best and the most apt example that comes to the mind is Java.', 'publish', 'post', 1, 2, 0, 21),
(32, '15-Feb-2019 11:21 PM', '5 Best Programming Languages for Kids', 'Java', 'sanket', 'post-image_file-java_framework.png', '<h3 id=\"8697\" class=\"graf graf--h3 graf-after--figure\">1.&nbsp;<a class=\"markup--anchor markup--h3-anchor\" href=\"https://www.tutorialspoint.com/spring/spring_web_mvc_framework.htm\" target=\"_blank\" rel=\"nofollow noopener\" data-href=\"https://www.tutorialspoint.com/spring/spring_web_mvc_framework.htm\">Spring&nbsp;MVC</a></h3>\r\n<p id=\"da40\" class=\"graf graf--p graf-after--figure\">Spring MVC is an open source, widely used framework. It provide a Model view controller architecture to developer which help him to develop web application in a speedy way. It based on DispatcherServlet which control all the HTTP request and responses.</p>\r\n<h3 id=\"660d\" class=\"graf graf--h3 graf-after--p\">2.&nbsp;<a class=\"markup--anchor markup--h3-anchor\" href=\"https://struts.apache.org/\" target=\"_blank\" rel=\"nofollow noopener\" data-href=\"https://struts.apache.org/\">Struts&nbsp;2</a></h3>\r\n<p id=\"158c\" class=\"graf graf--p graf-after--figure\">Apache strut 2 is the 2nd most popular and widely used framework.<br />This framework can easily be understood by new developers.<br />Struts 2 is open source framework which is based on MVC architecture pattern.<br />It is one of the flexible and most extensible framework to develop enterprise level web application.<br />Struts 2 implement the following core components.</p>\r\n<ul class=\"postList\">\r\n<li id=\"e2c9\" class=\"graf graf--li graf-after--p\">Actions</li>\r\n<li id=\"81d7\" class=\"graf graf--li graf-after--li\">Interceptors</li>\r\n<li id=\"9aed\" class=\"graf graf--li graf-after--li\">Value Stack / OGNL</li>\r\n<li id=\"48f9\" class=\"graf graf--li graf-after--li\">Results / Result types</li>\r\n<li id=\"0610\" class=\"graf graf--li graf-after--li\">View technologies</li>\r\n</ul>\r\n<h3 id=\"9829\" class=\"graf graf--h3 graf-after--li\">3,&nbsp;<a class=\"markup--anchor markup--h3-anchor\" href=\"https://projects.spring.io/spring-boot/\" target=\"_blank\" rel=\"nofollow noopener\" data-href=\"https://projects.spring.io/spring-boot/\">Spring&nbsp;Boot</a></h3>\r\n<p id=\"c598\" class=\"graf graf--p graf-after--figure\">Spring boot also an open source framework which is used for developing microservices.<br />With Spring Boot framework, you can create stand-alone spring application in which you have to do nothing just integrating and running it and it automatically integrate Spring when it possible.<br />Spring Boot provide the feature like Embed Tomcat, Jetty in which you do not have to deploy WAR files.</p>\r\n<h3 id=\"3534\" class=\"graf graf--h3 graf-after--p\">4.&nbsp;<a class=\"markup--anchor markup--h3-anchor\" href=\"http://axis.apache.org/axis/java/\" target=\"_blank\" rel=\"nofollow noopener\" data-href=\"http://axis.apache.org/axis/java/\">Apache&nbsp;Axis</a></h3>\r\n<p id=\"a350\" class=\"graf graf--p graf-after--figure\">It is an open source XML based framework which help developer to create deploy and run web services for client and server. This framework is a mixture of C++ and Java implementation of the SOAP server. Apache Axis is one of the most commonly used and one of the matured and most stable web service development framework.</p>\r\n<h3 id=\"c40b\" class=\"graf graf--h3 graf-after--p\">5.&nbsp;<a class=\"markup--anchor markup--h3-anchor\" href=\"http://hibernate.org/\" target=\"_blank\" rel=\"nofollow noopener\" data-href=\"http://hibernate.org/\">Hibernate</a></h3>\r\n<p>It is high-performance query service, it provide the persistence solution like managing persistent data. So the hibernate is an object/Relational Mapping (ORM) framework which is licensed under the open source GNU Lesser General Public License (LGPL) and it is available for free of cost. This framework take care of mapping from Java classes to SQL database table. It can be easily used by beginners and experienced developers.</p>', 'Get a breakdown of 5 of the most popular Java frameworks, from Spring MVC to Grails. See where each shines and where the fall flat.', 'publish', 'post', 0, 2, 0, 21),
(33, '15-Feb-2019 11:24 PM', '10 PHP Frameworks For Developers ', 'PHP', 'sanket', 'Techtiq-Why-PHP-Framework.png', '<p>PHP, known as the&nbsp;<a href=\"http://w3techs.com/technologies/overview/programming_language/all\" target=\"_blank\" rel=\"noopener\">most popular</a>&nbsp;server-side scripting language in the world, has&nbsp;<a href=\"https://www.hongkiat.com/blog/php7/\">evolved a lot</a>&nbsp;since the first inline code snippets appeared in static HTML files.</p>\r\n<p>These days developers need to build complex websites and web apps, and above a certain complexity level&nbsp;<strong>it can take too much time and hassle to always start from scratch</strong>, hence came the need for a more structured natural way of development. PHP frameworks provide developers with an adequate solution for that.</p>\r\n<p>In this post we carefully handpicked 10 popular PHP frameworks that can best&nbsp;<strong>facilitate and streamline the process of backend web development</strong>.</p>\r\n<h4>Why Use A PHP Framework</h4>\r\n<p>But first, let&rsquo;s take a look at the top reasons why many developers like to use PHP frameworks and how these frameworks can level up your development process. Here&rsquo;s what PHP frameworks do:</p>\r\n<ul>\r\n<li>Make speed development possible</li>\r\n<li>Provide well-organized, reusable and maintainable code</li>\r\n<li>Let you grow over time as web apps running on frameworks are scalable</li>\r\n<li>Spare you from the worries about low-level security of a site</li>\r\n<li>Follow the MVC (Model-View-Controller) pattern that ensures the separation of presentation and logic</li>\r\n<li>Promote modern web development practices such as object-oriented programming tools</li>\r\n</ul>\r\n<h4>1. Laravel</h4>\r\n<p>Although&nbsp;<a href=\"http://laravel.com/\" target=\"_blank\" rel=\"noopener\">Laravel</a>&nbsp;is a relatively new PHP framework (it was released in 2011), according to Sitepoint&rsquo;s recent online&nbsp;<a href=\"http://www.sitepoint.com/best-php-framework-2015-sitepoint-survey-results/\">survey</a>&nbsp;it is the most popular framework among developers. Laravel has a&nbsp;<a href=\"http://laravel.com/#ecosystem\" target=\"_blank\" rel=\"noopener\">huge ecosystem</a>&nbsp;with an&nbsp;<a href=\"https://forge.laravel.com/\" target=\"_blank\" rel=\"noopener\">instant hosting and deployment platform</a>, and its official website offers many screencast tutorials called&nbsp;<a href=\"https://laracasts.com/\" target=\"_blank\" rel=\"noopener\">Laracasts</a>.</p>\r\n<p>Laravel has many features that make rapid application development possible. Laravel has its own&nbsp;<strong>light-weight templating engine</strong>&nbsp;called &ldquo;Blade&rdquo;,&nbsp;<strong>elegant syntax</strong>&nbsp;that facilitates tasks you frequently need to do, such as authentication, sessions, queueing, caching and RESTful routing. Laravel also includes a&nbsp;<strong>local development environment</strong>&nbsp;called&nbsp;<a href=\"http://laravel.com/docs/5.1/homestead\" target=\"_blank\" rel=\"noopener\">Homestead</a>&nbsp;that is a packaged Vagrant box.</p>\r\n<h4>2. Symfony</h4>\r\n<p>The components of the&nbsp;<a href=\"https://symfony.com/\" target=\"_blank\" rel=\"noopener\">Symfony 2</a>&nbsp;framework are used by many impressive projects such as the&nbsp;<a class=\"broken_link\" href=\"https://www.drupal.org/\" target=\"_blank\" rel=\"nofollow noopener\">Drupal</a>&nbsp;content management system, or the&nbsp;<a href=\"https://www.phpbb.com/\" target=\"_blank\" rel=\"noopener\">phpBB</a>&nbsp;forum software, but Laravel &ndash; the framework listed above &ndash;&nbsp;<strong>also relies on it</strong>. Symfony has a&nbsp;<strong>wide developer community</strong>&nbsp;and many ardent fans.</p>\r\n<p><a href=\"http://symfony.com/components\" target=\"_blank\" rel=\"noopener\">Symfony Components</a>&nbsp;are&nbsp;<strong>reusable PHP libraries that you can complete different tasks with</strong>, such as form creation, object configuration, routing, authentication, templating, and many others. You can install any of the Components with the&nbsp;<a href=\"https://getcomposer.org/\" target=\"_blank\" rel=\"noopener\">Composer</a>&nbsp;PHP dependency manager. The website of Symfony has a cool&nbsp;<a class=\"broken_link\" href=\"http://symfony.com/showcase/\" target=\"_blank\" rel=\"nofollow noopener\">showcase</a>&nbsp;section where you can take a peek at the projects developers accomplished with the help of this handy framework.</p>\r\n<h4>3. CodeIgniter</h4>\r\n<p><a href=\"http://www.codeigniter.com/\" target=\"_blank\" rel=\"noopener\">CodeIgniter</a>&nbsp;is a lightweight PHP framework that is almost 10 years old (initially released in 2006). CodeIgniter has a very straightforward installation process that requires only a minimal configuration, so it can save you a lot of hassle. It&rsquo;s also an ideal choice if you want to&nbsp;<strong>avoid PHP version conflict</strong>, as it&nbsp;<strong>works nicely on almost all shared and dedicated hosting platforms</strong>&nbsp;(currently requires only PHP 5.2.4).</p>\r\n<p>CodeIgniter is not strictly based on the MVC development pattern. Using Controller classes is a must, but Models and Views are optional, and you can use your own coding and naming conventions, evidence that CodeIgniter gives great freedom to developers. If you download it, you&rsquo;ll see it&rsquo;s only about 2MB, so it&rsquo;s a lean framework, but it allows you to add third-party plugins if you need more complicated functionalities.</p>\r\n<h4>4. Yii 2</h4>\r\n<p>If you choose the&nbsp;<a href=\"http://www.yiiframework.com/\" target=\"_blank\" rel=\"noopener\">Yii</a>&nbsp;framework you give a&nbsp;<a href=\"http://www.yiiframework.com/performance/\" target=\"_blank\" rel=\"noopener\">boost to the performance</a>&nbsp;of your site as it&rsquo;s&nbsp;<strong>faster than other PHP frameworks</strong>, because&nbsp;<strong>it extensively uses the lazy loading technique</strong>. Yii 2 is purely&nbsp;<strong>object-oriented</strong>, and it&rsquo;s based on the&nbsp;<strong>DRY</strong>(Don&rsquo;t Repeat Yourself) coding concept, so it provides you with a&nbsp;<strong>pretty clean and logical code base</strong>.</p>\r\n<p>Yii 2 is integrated with jQuery, and it comes with a set of AJAX-enabled features, and it implements an easy-to-use skinning and theming mechanism, so it can be a great choice for someone who&nbsp;<strong>comes from a frontend background</strong>. It has also a powerful class code generator called&nbsp;<a href=\"http://www.yiiframework.com/doc-2.0/guide-tool-gii.html\" target=\"_blank\" rel=\"noopener\">Gii</a>&nbsp;that facilitates object-oriented programming and rapid prototyping, and provides a web-based interface that allows you to interactively generate the code you need.</p>\r\n<h4>5. Phalcon</h4>\r\n<p>The&nbsp;<a href=\"https://phalconphp.com/en/\" target=\"_blank\" rel=\"noopener\">Phalcon</a>&nbsp;framework was released in 2012, and it quickly gained popularity among PHP developers. Phalcon is said to be fast as a falcon, because it was&nbsp;<strong>written in C and C++ to reach the highest level of performance optimization</strong>&nbsp;possible. Good news is that you don&rsquo;t have to learn the C language, as the functionality is&nbsp;<strong>exposed as PHP classes that are ready to use for any application</strong>.</p>\r\n<p>As Phalcon is delivered as a C-extension, its architecture is optimized at low levels which&nbsp;<strong>significantly reduces the overhead typical of MVC-based apps</strong>. Phalcon not only boosts execution speeds, but also decreases resource usage. Phalcon is also packed with many cool features such as a universal auto-loader, asset management, security, translation, caching, and many others. As it&rsquo;s a&nbsp;<a href=\"https://docs.phalconphp.com/en/latest/index.html\" target=\"_blank\" rel=\"noopener\">well-documented</a>&nbsp;and easy-to-use framework, it&rsquo;s definitely worth a try.</p>', 'PHP, known as the most popular server-side scripting language in the world, has evolved a lot since the first inline code snippets appeared in static HTML files.', 'publish', 'post', 1, 3, 0, 22),
(34, '04-Mar-2019 08:12 PM', 'PHP 5 Sessions', 'PHP', 'sanket', '', '<p>dsasdsadsad</p>', 'sdsadsad', 'publish', 'post', 0, 1, 0, 22),
(35, '04-Mar-2019 08:15 PM', 'BLUEHOST DISCOUNT', '', 'sanket', '', '<h1>[Deal Alert] BlueHost Hosting Coupon: Save 66% + Free Domain</h1>\r\n<p><a href=\"https://www.shoutmeloud.com/recommended/Bluehost/\" rel=\"nofollow\">Bluehost Webhosting</a>&nbsp;is officially recommended by WordPress hosting page, and it&rsquo;s the best choice for your WordPress site. Before I share this special Bluehost coupon, let me give you a brief about Bluehost plans and packages.</p>\r\n<p><a href=\"https://www.shoutmeloud.com/recommended/Bluehost/\">Skip everything &amp; claim your discount now</a></p>\r\n<p>There are only a couple of shared hosting services which have actually managed to impress me. Because I create all my blogs on the WordPress platform from past 10 years, I have used &amp; tested many different web-hosting services including&nbsp;<a title=\"Hostgator\" href=\"https://www.shoutmeloud.com/hostgator-discount-coupon\">Hostgator</a>,&nbsp;<a href=\"https://www.shoutmeloud.com/recommended/Siteground/\">SiteGround</a>,&nbsp;Bluehost, and others.</p>\r\n<p>Bluehost always emerges as a&nbsp;winner for WordPress hosting, and the key to their&nbsp;success is the fact that their servers are optimized for the WordPress platform. Moreover, for a beginner who is looking for a high quality hosting in the budget.</p>\r\n<p>In this article, I&rsquo;m sharing special&nbsp;<strong>Bluehost promo discount&nbsp;ranging from $2.95 to $5.95/month&nbsp;</strong>and before that let&rsquo;s discuss some&nbsp;of the Bluehost&rsquo;s hosting features that make it worth buying.</p>\r\n<p>Bluehost offers 3 shared hosting package, and all packages come with one free domain name, Free SSL Certificate &amp; PHP 7.0 support. Here are the packages:</p>\r\n<ul>\r\n<li>Bluehost Basic: Let you host 1 website</li>\r\n<li>Bluehost Plus: Let you host up to 10 Websites (&nbsp;<strong>Recommended plan</strong>)</li>\r\n<li>Bluehost Prime: Recommended for those who need&nbsp;who.is privacy for domain.</li>\r\n</ul>\r\n<p><img src=\"https://www.shoutmeloud.com/wp-content/uploads/2016/12/Bluehost-packages-coupon.png\" alt=\"\" /></p>', '', 'publish', 'page', 0, 0, 0, 0),
(36, '04-Mar-2019 11:11 PM', 'About', '', 'sanket', '', '<blockquote>\r\n<pre><strong>ShoutMeLoud is part of a&nbsp;movement to liberate&nbsp;every human being from the 9-5 job!</strong></pre>\r\n</blockquote>', '', 'trash', 'page', 0, 0, 0, 0),
(37, '04-Mar-2019 11:43 PM', 'About', '', 'sanket', '', '<blockquote><strong>Tech Geek</strong> is part of a movement to liberate every human being from the 9-5</blockquote>\r\n<p><strong><em>Spoiler: This is long yet interesting!&nbsp;</em></strong></p>\r\n<p><strong>Howdy, Geekyyyyy!</strong></p>\r\n<p>Welcome to Tech Geek(TC) &ndash; A community of enthusiastic bloggers who are popularly known as &ldquo;Geeky&rdquo;!</p>\r\n<p>These are bloggers who are&nbsp;<strong>living a boss-free life</strong>&nbsp;or are currently moving in that direction.</p>\r\n<p><em>Don&rsquo;t we??</em></p>\r\n<p>Something which started as a bit of fun turned out to be the&nbsp;<strong>biggest life-changing experience</strong>&nbsp;for me.&nbsp;In the last ten years, ShoutMeLoud has become more than just a popular blog.</p>\r\n<p>With more than&nbsp;<strong><em>1 million page views a month</em>,</strong>&nbsp;it has made a positive impact on many people&rsquo;s lives.</p>\r\n<p>&nbsp;</p>\r\n<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong>ABOUT ME</strong></span></h2>\r\n<p><span style=\"text-decoration: underline;\"><strong><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://pbs.twimg.com/profile_images/1053694327409569794/jZnL5Amm_400x400.jpg\" alt=\"\" width=\"171\" height=\"171\" /></strong></span></p>\r\n<h2 style=\"text-align: center;\"><em><span id=\"Man_Behind_ShoutMeLoud_Harsh_Agrawal_Thats_me_in_the_middle\" class=\"ez-toc-section\"><strong>Man Behind Tech Geek: sanket Khote.</strong></span></em></h2>\r\n<p>&nbsp;</p>\r\n<p>I am the fountainhead of Tech Geek.</p>\r\n<p>I may use big words at times, but I&rsquo;m a really&nbsp;<strong>simple</strong>&nbsp;guy who loves to&nbsp;<strong>simplify complex stuff. &nbsp;</strong></p>\r\n<p>I started blogging out of my&nbsp;passions for learning &amp; sharing.&nbsp;<strong>In 2017, I got to know about blogging</strong>&nbsp;&amp; within a month, I was live with my first blog.</p>\r\n<p>The idea of connecting with the like-minded people and be able to share my knowledge with the world, I couldn&rsquo;t resist the temptation of taking it seriously.&nbsp;</p>\r\n<p>I started on the BlogSpot platform &amp; within two months I moved to WordPress.</p>', '', 'publish', 'page', 0, 0, 0, 0),
(38, '04-Mar-2019 11:55 PM', 'Future of Java', 'Java', 'sanket', '', '<p><em>Java</em>&nbsp;is a programming language that produces software for multiple platforms. When a programmer writes a&nbsp;<em>Java</em>&nbsp;application, the compiled code</p>', 'Java is a programming language that produces software for multiple platforms. When a programmer writes a Java application, the compiled code', 'trash', 'post', 0, 0, 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `bio` mediumtext NOT NULL,
  `detail` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `registered_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `website`, `fname`, `lname`, `bio`, `detail`, `password`, `img`, `registered_date`) VALUES
(12, 'Sanket', 'sanketkhote43@gmail.com', 'http://localhost/blog/', 'Sanket', 'Khote', 'Hello Guys, I\'m Sanket Khote. Prof. Web Developer And Designer.', 'Hello Guys, I\'m Sanket Khote. Prof. Web Developer And Designer.', '123', 'user.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
