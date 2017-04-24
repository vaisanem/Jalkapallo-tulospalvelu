INSERT INTO League (name) VALUES ('Ykkönen');
INSERT INTO League (name) VALUES ('Kakkonen');
INSERT INTO League (name) VALUES ('Kolmonen');
INSERT INTO Team (name, ground) VALUES ('NPS', 'Kenttä');
INSERT INTO Team (name, ground) VALUES ('Hämeen Palloilijat', 'Stadion');
INSERT INTO Team (name, ground) VALUES ('Härmän Palloilijat', 'Tekis');
INSERT INTO Team (name) VALUES ('KiPS');
INSERT INTO Person (name, password, mode) VALUES ('Yllä', 'Pitäjä', '2');
INSERT INTO Person (name, password, mode) VALUES ('Enole', 'Ylläpitäjä', '1');
INSERT INTO Person (name, password, mode) VALUES ('Ensaa', 'Muokata', '0');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('1', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('1', '2');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('2', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('4', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('3', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '2', '3', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('2', '1', '3', '3', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '2', '1', '0', '3');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '4', '1', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '4', '1', '1', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '2', '4', '2', '2');

