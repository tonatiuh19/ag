ALTER TABLE reservas
ADD FOREIGN KEY (id_paquete) REFERENCES paquetes(id_paquete);