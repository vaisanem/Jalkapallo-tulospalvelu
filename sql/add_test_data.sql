INSERT INTO League (name) VALUES ('Ykkönen');
INSERT INTO League (name) VALUES ('Kakkonen');
INSERT INTO League (name) VALUES ('Kolmonen');
INSERT INTO Team (name, ground) VALUES ('NPS', 'Kenttä');
INSERT INTO Team (name, ground) VALUES ('Hämeen Palloilijat', 'Stadion');
INSERT INTO Team (name, ground) VALUES ('Härmän Palloilijat', 'Tekis');
INSERT INTO Team (name, ground) VALUES ('JPS', 'Stadium');
INSERT INTO Team (name, ground) VALUES ('RePS', 'Urheilukenttä');
INSERT INTO Team (name) VALUES ('KoPS');
INSERT INTO Team (name) VALUES ('FC Pallo');
INSERT INTO Person (name, password, mode) VALUES ('Yllä', 'Pitäjä', '2');
INSERT INTO Person (name, password, mode) VALUES ('Enole', 'Ylläpitäjä', '1');
INSERT INTO Person (name, password, mode) VALUES ('Ensaa', 'Muokata', '0');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('1', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('2', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('3', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('5', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('6', '1');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('4', '2');
INSERT INTO LeagueTeam (team_id, league_id) VALUES ('7', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '2', '3', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '2', '1', '0', '3');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '3', '1', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '3', '1', '1', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '2', '3', '2', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '3', '2', '1', '2');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '5', '6', '1', '1');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '5', '6', '1', '1');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '5', '1', '1', '1');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '1', '6', '1', '1');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '6', '3', '4', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '3', '6', '1', '3');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '6', '2', '2', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('1', '5', '3', '0', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('2', '4', '7', '3', '0');
INSERT INTO Game (league, home_team, away_team, home_goals, away_goals)
     VALUES ('2', '7', '4', '2', '0');

