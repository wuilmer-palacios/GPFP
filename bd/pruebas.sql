SELECT * FROM alcances_has_cp_participantes
INNER JOIN planes_tacticos ON alcances.planTactico = planes_tacticos.idPlan
INNER JOIN  ON alcances_has_cp_participantes.idParticipante = participantes.idParticipante
WHERE idParticipante=1