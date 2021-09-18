CREATE VIEW empleado_det AS
Select E.primer_apellido
, E.segundo_apellido
, E.primer_nombre
, E.segundo_nombre
, E.id_pais
, P.pais
, E.tipo_identificacion as id_identificacion
, TI.tipo_identificacion
, E.numero_identificacion
, E.email
, E.estado
, DATE_FORMAT(E.fecha_registro,"%Y-%m-%d") as fecha_registro
, E.id
From empleado E inner join pais P On E.id_pais = P.id
Inner Join tipo_identificacion TI On E.tipo_identificacion = TI.id