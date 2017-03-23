INSERT INTO League (name) VALUES ('Ykkönen');
INSERT INTO Team (name, ground) VALUES ('NPS', 'Kenttä');
INSERT INTO Team (name, ground) VALUES ('Hämeen Palloilijat', 'Stadion');
INSERT INTO Person (name, password) VALUES ('Testi', 'Käyttäjä');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('1', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('2', '1');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '2', '3', '0');

