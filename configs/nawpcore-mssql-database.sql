USE [master]
GO
/****** Object:  Database [atlas]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE DATABASE [atlas]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'atlas', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\atlas2.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON
( NAME = N'atlas_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\atlas_log25.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [atlas] SET COMPATIBILITY_LEVEL = 140
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [atlas].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [atlas] SET ANSI_NULL_DEFAULT OFF
GO
ALTER DATABASE [atlas] SET ANSI_NULLS OFF
GO
ALTER DATABASE [atlas] SET ANSI_PADDING OFF
GO
ALTER DATABASE [atlas] SET ANSI_WARNINGS OFF
GO
ALTER DATABASE [atlas] SET ARITHABORT OFF
GO
ALTER DATABASE [atlas] SET AUTO_CLOSE ON
GO
ALTER DATABASE [atlas] SET AUTO_SHRINK OFF
GO
ALTER DATABASE [atlas] SET AUTO_UPDATE_STATISTICS ON
GO
ALTER DATABASE [atlas] SET CURSOR_CLOSE_ON_COMMIT OFF
GO
ALTER DATABASE [atlas] SET CURSOR_DEFAULT  GLOBAL
GO
ALTER DATABASE [atlas] SET CONCAT_NULL_YIELDS_NULL OFF
GO
ALTER DATABASE [atlas] SET NUMERIC_ROUNDABORT OFF
GO
ALTER DATABASE [atlas] SET QUOTED_IDENTIFIER OFF
GO
ALTER DATABASE [atlas] SET RECURSIVE_TRIGGERS OFF
GO
ALTER DATABASE [atlas] SET  DISABLE_BROKER
GO
ALTER DATABASE [atlas] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
GO
ALTER DATABASE [atlas] SET DATE_CORRELATION_OPTIMIZATION OFF
GO
ALTER DATABASE [atlas] SET TRUSTWORTHY OFF
GO
ALTER DATABASE [atlas] SET ALLOW_SNAPSHOT_ISOLATION OFF
GO
ALTER DATABASE [atlas] SET PARAMETERIZATION SIMPLE
GO
ALTER DATABASE [atlas] SET READ_COMMITTED_SNAPSHOT OFF
GO
ALTER DATABASE [atlas] SET HONOR_BROKER_PRIORITY OFF
GO
ALTER DATABASE [atlas] SET RECOVERY SIMPLE
GO
ALTER DATABASE [atlas] SET  MULTI_USER
GO
ALTER DATABASE [atlas] SET PAGE_VERIFY CHECKSUM
GO
ALTER DATABASE [atlas] SET DB_CHAINING OFF
GO
ALTER DATABASE [atlas] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF )
GO
ALTER DATABASE [atlas] SET TARGET_RECOVERY_TIME = 60 SECONDS
GO
ALTER DATABASE [atlas] SET DELAYED_DURABILITY = DISABLED
GO
ALTER DATABASE [atlas] SET QUERY_STORE = OFF
GO
USE [atlas]
GO
ALTER DATABASE SCOPED CONFIGURATION SET IDENTITY_CACHE = ON;
GO
ALTER DATABASE SCOPED CONFIGURATION SET LEGACY_CARDINALITY_ESTIMATION = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET LEGACY_CARDINALITY_ESTIMATION = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET MAXDOP = 0;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET MAXDOP = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET PARAMETER_SNIFFING = ON;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET PARAMETER_SNIFFING = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET QUERY_OPTIMIZER_HOTFIXES = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET QUERY_OPTIMIZER_HOTFIXES = PRIMARY;
GO
USE [atlas]
GO
/****** Object:  User [Admin]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE USER [Admin] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[categorie]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[categorie](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[title] [varchar](255) NOT NULL,
	[content] [varchar](max) NOT NULL,
	[parent] [int] NULL,
	[author] [int] NOT NULL,
 CONSTRAINT [PK_categorie] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[content]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[content](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[title] [varchar](255) NOT NULL,
	[content] [varchar](max) NOT NULL,
	[author] [int] NOT NULL,
	[draft] [bit] NOT NULL,
	[parent] [int] NULL,
 CONSTRAINT [PK_Contents] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contents_categories]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contents_categories](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[content] [int] NOT NULL,
	[categorie] [int] NOT NULL,
 CONSTRAINT [PK_ContentsCategories] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[log]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[log](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[author] [int] NOT NULL,
	[model] [varchar](255) NOT NULL,
	[id] [int] NOT NULL,
	[previous_value] [varchar](max) NOT NULL,
	[new_value] [varchar](max) NOT NULL,
 CONSTRAINT [PK_log] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[translation]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[translation](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[lang] [varchar](10) NOT NULL,
	[key] [varchar](500) NOT NULL,
	[value] [nchar](10) NOT NULL,
	[author] [int] NOT NULL,
 CONSTRAINT [PK_translation] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user]    Script Date: 10/13/2018 4:01:45 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user](
	[row_id] [int] IDENTITY(1,1) NOT NULL,
	[inserted_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[birth_place] [varchar](255) NULL,
	[birth_day] [varchar](255) NULL,
	[email] [varchar](255) NOT NULL,
	[email] [varchar](255) NOT NULL,
	[first_name] [varchar](255) NULL,
	[last_name] [varchar](255) NULL,
	[hashed_password] [varchar](500) NULL,
	[rgpd] [bit] NOT NULL,
	[newsletter] [bit] NOT NULL,
	[role] [tinyint] NOT NULL,
 CONSTRAINT [PK_user] PRIMARY KEY CLUSTERED
(
	[row_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Index [Idx_categorie_author]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_categorie_author] ON [dbo].[categorie]
(
	[author] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_categorie_parent]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_categorie_parent] ON [dbo].[categorie]
(
	[parent] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_content_author]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_content_author] ON [dbo].[content]
(
	[author] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_content_parent]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_content_parent] ON [dbo].[content]
(
	[parent] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_contents_categories_categorie]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_contents_categories_categorie] ON [dbo].[contents_categories]
(
	[categorie] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_contents_categories_content]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_contents_categories_content] ON [dbo].[contents_categories]
(
	[content] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_log_author]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_log_author] ON [dbo].[log]
(
	[author] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_log_id]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_log_id] ON [dbo].[log]
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_translation_author]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_translation_author] ON [dbo].[translation]
(
	[author] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [Idx_user_role]    Script Date: 10/13/2018 4:01:45 PM ******/
CREATE NONCLUSTERED INDEX [Idx_user_role] ON [dbo].[user]
(
	[role] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[categorie] ADD  CONSTRAINT [DF_categorie_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[categorie] ADD  CONSTRAINT [DF_categorie_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[content] ADD  CONSTRAINT [DF_Contents_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[content] ADD  CONSTRAINT [DF_Contents_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[content] ADD  CONSTRAINT [DF_Contents_draft]  DEFAULT ((1)) FOR [draft]
GO
ALTER TABLE [dbo].[contents_categories] ADD  CONSTRAINT [DF_ContentsCategories_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[contents_categories] ADD  CONSTRAINT [DF_ContentsCategories_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[log] ADD  CONSTRAINT [DF_log_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[log] ADD  CONSTRAINT [DF_log_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[translation] ADD  CONSTRAINT [DF_translation_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[translation] ADD  CONSTRAINT [DF_translation_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_insrted_at]  DEFAULT (getdate()) FOR [inserted_at]
GO
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_updated_at]  DEFAULT (getdate()) FOR [updated_at]
GO
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_rgpd]  DEFAULT ((0)) FOR [rgpd]
GO
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_newsletter]  DEFAULT ((0)) FOR [newsletter]
GO
ALTER TABLE [dbo].[categorie]  WITH CHECK ADD  CONSTRAINT [Fk_categorie_categorie] FOREIGN KEY([parent])
REFERENCES [dbo].[categorie] ([row_id])
GO
ALTER TABLE [dbo].[categorie] CHECK CONSTRAINT [Fk_categorie_categorie]
GO
ALTER TABLE [dbo].[categorie]  WITH CHECK ADD  CONSTRAINT [Fk_categorie_user] FOREIGN KEY([author])
REFERENCES [dbo].[user] ([row_id])
GO
ALTER TABLE [dbo].[categorie] CHECK CONSTRAINT [Fk_categorie_user]
GO
ALTER TABLE [dbo].[content]  WITH CHECK ADD  CONSTRAINT [Fk_content_content] FOREIGN KEY([parent])
REFERENCES [dbo].[content] ([row_id])
GO
ALTER TABLE [dbo].[content] CHECK CONSTRAINT [Fk_content_content]
GO
ALTER TABLE [dbo].[content]  WITH CHECK ADD  CONSTRAINT [Fk_content_user] FOREIGN KEY([author])
REFERENCES [dbo].[user] ([row_id])
GO
ALTER TABLE [dbo].[content] CHECK CONSTRAINT [Fk_content_user]
GO
ALTER TABLE [dbo].[contents_categories]  WITH CHECK ADD  CONSTRAINT [Fk_contents_categories_categorie] FOREIGN KEY([categorie])
REFERENCES [dbo].[categorie] ([row_id])
GO
ALTER TABLE [dbo].[contents_categories] CHECK CONSTRAINT [Fk_contents_categories_categorie]
GO
ALTER TABLE [dbo].[contents_categories]  WITH CHECK ADD  CONSTRAINT [Fk_contents_categories_content] FOREIGN KEY([content])
REFERENCES [dbo].[content] ([row_id])
GO
ALTER TABLE [dbo].[contents_categories] CHECK CONSTRAINT [Fk_contents_categories_content]
GO
ALTER TABLE [dbo].[log]  WITH CHECK ADD  CONSTRAINT [Fk_log_content] FOREIGN KEY([id])
REFERENCES [dbo].[content] ([row_id])
GO
ALTER TABLE [dbo].[log] CHECK CONSTRAINT [Fk_log_content]
GO
ALTER TABLE [dbo].[log]  WITH CHECK ADD  CONSTRAINT [Fk_log_user] FOREIGN KEY([author])
REFERENCES [dbo].[user] ([row_id])
GO
ALTER TABLE [dbo].[log] CHECK CONSTRAINT [Fk_log_user]
GO
ALTER TABLE [dbo].[translation]  WITH CHECK ADD  CONSTRAINT [Fk_translation_user_0] FOREIGN KEY([author])
REFERENCES [dbo].[user] ([row_id])
GO
ALTER TABLE [dbo].[translation] CHECK CONSTRAINT [Fk_translation_user_0]
GO
USE [master]
GO
ALTER DATABASE [atlas] SET  READ_WRITE 
GO
