--
-- PostgreSQL database dump
--

-- Dumped from database version 15.6 (Debian 15.6-1.pgdg120+2)
-- Dumped by pg_dump version 16.2 (Debian 16.2-1.pgdg120+2)

-- Started on 2024-04-24 11:31:44 -04

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 24582)
-- Name: task; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.task (
    id_task integer NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.task OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 24581)
-- Name: task_id_task_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.task_id_task_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.task_id_task_seq OWNER TO postgres;

--
-- TOC entry 3352 (class 0 OID 0)
-- Dependencies: 214
-- Name: task_id_task_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.task_id_task_seq OWNED BY public.task.id_task;


--
-- TOC entry 3199 (class 2604 OID 24585)
-- Name: task id_task; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task ALTER COLUMN id_task SET DEFAULT nextval('public.task_id_task_seq'::regclass);


--
-- TOC entry 3346 (class 0 OID 24582)
-- Dependencies: 215
-- Data for Name: task; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.task (id_task, title, description, created_at) FROM stdin;
1	Comprar agua	Ir a la tienda y comprar agua.	2024-04-23 15:50:58.902061
2	prueba 2	probando descripcion	2024-04-24 10:50:05.83321
3	prueba 3	probando descripcion del agua	2024-04-24 10:50:18.58291
\.


--
-- TOC entry 3353 (class 0 OID 0)
-- Dependencies: 214
-- Name: task_id_task_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.task_id_task_seq', 3, true);


--
-- TOC entry 3202 (class 2606 OID 24590)
-- Name: task task_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.task
    ADD CONSTRAINT task_pkey PRIMARY KEY (id_task);


-- Completed on 2024-04-24 11:31:44 -04

--
-- PostgreSQL database dump complete
--

