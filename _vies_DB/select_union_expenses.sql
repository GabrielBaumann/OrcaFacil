SELECT "Material" AS tipo_gasto, id_work, (amount * price_unit) AS total_value
FROM expenses_material

UNION ALL

SELECT 
	"Mão de Obra" AS tipo_gasto, 
	id_work, 
	CASE
		WHEN format_work = "DIARIA" THEN days_worked * value_daily
        WHEN format_work = "EMPREITA" THEN contract_value
        ELSE 0
	END AS total_value
FROM expenses_labor;