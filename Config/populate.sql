INSERT INTO contato_setor (cod_setor, nome_setor, email) VALUES 
('1', 'Atendimento ao Cliente', 'thomfilg@gmail.com');

INSERT INTO contato_assunto (cod_assunto, cod_setor, anome, ordem) VALUES 
('1', '1', 'Outros Assuntos', 1);

INSERT INTO contato_campo (`cod_campo`, `label`, `cod_assunto`, `type`, `size`,`ordem`) VALUES 
('1', 'Detalhes do Assunto', '1', 'varchar', '64', '99999');