CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

GRANT USAGE ON SCHEMA public TO postgres;
GRANT EXECUTE ON FUNCTION uuid_generate_v4() TO postgres;


CREATE TABLE public.produtos (
	id uuid primary key not null default uuid_generate_v4() ,
	nome varchar NULL,
	valor decimal NULL
);
