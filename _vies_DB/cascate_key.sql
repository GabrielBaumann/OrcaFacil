ALTER TABLE expenses_rental_equipment
ADD CONSTRAINT fk_expenses_rental_equipment
FOREIGN KEY (id_work) REFERENCES work_client(id_work)
ON DELETE CASCADE;
