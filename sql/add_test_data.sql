INSERT INTO League (name) VALUES ('Ykkönen');
INSERT INTO League (name) VALUES ('Kakkonen');
INSERT INTO League (name) VALUES ('Kolmonen');
INSERT INTO Team (name, ground) VALUES ('NPS', 'Kenttä');
INSERT INTO Team (name, ground) VALUES ('Hämeen Palloilijat', 'Stadion');
INSERT INTO Team (name, ground) VALUES ('Härmän Palloilijat', 'Tekis');
INSERT INTO Team (name) VALUES ('KiPS');
INSERT INTO Person (name, password, mode) VALUES ('Testi', 'Käyttäjä', '1');
INSERT INTO Person (name, password, mode) VALUES ('Enole', 'Ylläpitäjä', '0');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('1', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('2', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('3', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '2', '3', '0');

