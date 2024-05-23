--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2 (Debian 16.2-1.pgdg120+2)
-- Dumped by pg_dump version 16.2 (Debian 16.2-1.pgdg120+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: docker
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO docker;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: docker
--

COMMENT ON SCHEMA public IS '';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: Film2User; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."Film2User" (
    "filmId" uuid NOT NULL,
    "userId" uuid NOT NULL,
    rate integer NOT NULL,
    "createdAt" timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public."Film2User" OWNER TO docker;

--
-- Name: FilmDetails; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."FilmDetails" (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    "filmId" uuid NOT NULL,
    description text NOT NULL,
    "releaseDate" date NOT NULL,
    "createdAt" timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public."FilmDetails" OWNER TO docker;

--
-- Name: Films; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."Films" (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    title character varying(100) NOT NULL,
    "posterUrl" character varying(255) NOT NULL,
    "avgRate" real DEFAULT 0 NOT NULL,
    "createdAt" timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public."Films" OWNER TO docker;

--
-- Name: FilmsWithDetails; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public."FilmsWithDetails" AS
 SELECT f.id,
    f.title,
    f."posterUrl",
    f."avgRate",
    fd.description,
    fd."releaseDate",
    f."createdAt" AS "filmCreatedAt"
   FROM (public."Films" f
     JOIN public."FilmDetails" fd ON ((f.id = fd."filmId")))
  ORDER BY f."createdAt" DESC;


ALTER VIEW public."FilmsWithDetails" OWNER TO docker;

--
-- Name: Roles; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."Roles" (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    name character varying(100) NOT NULL,
    "createdAt" timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public."Roles" OWNER TO docker;

--
-- Name: Users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public."Users" (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    username character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    "createdAt" timestamp without time zone DEFAULT now() NOT NULL,
    "roleId" uuid NOT NULL
);


ALTER TABLE public."Users" OWNER TO docker;

--
-- Name: UsersRole; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public."UsersRole" AS
 SELECT u.id,
    u.username,
    u.email,
    u.password,
    u."createdAt",
    u."roleId",
    r.name AS "roleName"
   FROM (public."Users" u
     JOIN public."Roles" r ON ((u."roleId" = r.id)));


ALTER VIEW public."UsersRole" OWNER TO docker;

--
-- Data for Name: Film2User; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."Film2User" ("filmId", "userId", rate, "createdAt") FROM stdin;
\.


--
-- Data for Name: FilmDetails; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."FilmDetails" (id, "filmId", description, "releaseDate", "createdAt") FROM stdin;
\.


--
-- Data for Name: Films; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."Films" (id, title, "posterUrl", "avgRate", "createdAt") FROM stdin;
\.


--
-- Data for Name: Roles; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."Roles" (id, name, "createdAt") FROM stdin;
d51ad8e0-da9f-4a17-82f1-a56105db5d93	admin	2024-05-01 09:06:11.142986
1a05d176-93c0-48bd-a13a-0ce0b99e82e6	user	2024-05-01 09:06:11.142986
\.


--
-- Data for Name: Users; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public."Users" (id, username, email, password, "createdAt", "roleId") FROM stdin;
c9bab207-9c90-426d-888f-2389611b5190	admin	admin@filmrate.test	$2y$10$BGoB59ofH9ajEdXXL3liFuDW2ad94XBa4gNy508jBNI8J3R6ZoWUy	2024-05-11 15:01:53.011603	d51ad8e0-da9f-4a17-82f1-a56105db5d93
3fbcec19-2038-494e-8025-d2d86b05c53b	user	user@filmrate.test	$2y$10$b2ERHtjDcxoyUhqqIOhlz.6D9ghXb3fiV5/aeewLYNJlNcXgy0hrG	2024-05-11 15:04:47.898854	1a05d176-93c0-48bd-a13a-0ce0b99e82e6
\.


--
-- Name: Film2User Film2User_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Film2User"
    ADD CONSTRAINT "Film2User_pkey" PRIMARY KEY ("filmId", "userId");


--
-- Name: FilmDetails FilmDetails_filmId_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."FilmDetails"
    ADD CONSTRAINT "FilmDetails_filmId_key" UNIQUE ("filmId");


--
-- Name: FilmDetails FilmDetails_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."FilmDetails"
    ADD CONSTRAINT "FilmDetails_pkey" PRIMARY KEY (id);


--
-- Name: Films Films_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Films"
    ADD CONSTRAINT "Films_pkey" PRIMARY KEY (id);


--
-- Name: Roles Roles_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Roles"
    ADD CONSTRAINT "Roles_pkey" PRIMARY KEY (id);


--
-- Name: Users Users_email_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Users_email_key" UNIQUE (email);


--
-- Name: Users Users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (id);


--
-- Name: Users Users_username_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Users_username_key" UNIQUE (username);


--
-- Name: Film2User Film2User_filmId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Film2User"
    ADD CONSTRAINT "Film2User_filmId_fkey" FOREIGN KEY ("filmId") REFERENCES public."Films"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Film2User Film2User_userId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Film2User"
    ADD CONSTRAINT "Film2User_userId_fkey" FOREIGN KEY ("userId") REFERENCES public."Users"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: FilmDetails FilmDetails_filmId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."FilmDetails"
    ADD CONSTRAINT "FilmDetails_filmId_fkey" FOREIGN KEY ("filmId") REFERENCES public."Films"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: Users Users_roleId_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public."Users"
    ADD CONSTRAINT "Users_roleId_fkey" FOREIGN KEY ("roleId") REFERENCES public."Roles"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: docker
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;


--
-- PostgreSQL database dump complete
--

