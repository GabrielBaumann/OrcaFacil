SELECT
	expenses_rental_equipment.id_expenses_rental_equipment,
    work_client.name_work,
    expenses_rental_equipment.id_work,
    costs_rental_equipment.name_equipment,
    "un",
    expenses_rental_equipment.amount_equipment,
    expenses_rental_equipment.value_daily,
    DATEDIFF(expenses_rental_equipment.date_end, expenses_rental_equipment.date_start) AS daily_quant,
    CAST((DATEDIFF(expenses_rental_equipment.date_end, expenses_rental_equipment.date_start) * expenses_rental_equipment.value_daily) AS DECIMAL (10,2)) AS total_price,
    steps_work.steps_work,
    expenses_rental_equipment.budget
    
FROM
	expenses_rental_equipment
JOIN
	costs_rental_equipment ON expenses_rental_equipment.id_costs_rental_equipment = costs_rental_equipment.id_costs_rental_equipment
JOIN
	work_client ON expenses_rental_equipment.id_work = work_client.id_work
JOIN
	steps_work ON expenses_rental_equipment.id_steps_work = steps_work.id_steps_work;
    

