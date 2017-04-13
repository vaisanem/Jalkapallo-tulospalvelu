CREATE TABLE Person (
        id SERIAL PRIMARY KEY,
        name varchar(30) NOT NULL UNIQUE,
        password varchar(30) NOT NULL,
        mode integer DEFAULT 0
        );

CREATE TABLE League (
        id SERIAL PRIMARY KEY,
        name varchar(30) NOT NULL UNIQUE
        );

CREATE TABLE Team (
        id SERIAL PRIMARY KEY,
        name varchar(30) NOT NULL UNIQUE,
        ground varchar(30)
        );

CREATE TABLE LeagueTeam (
        id SERIAL PRIMARY KEY,
        team_id INTEGER NOT NULL,
        league_id INTEGER NOT NULL,
        FOREIGN KEY(team_id) REFERENCES Team(id),
        FOREIGN KEY(league_id) REFERENCES League(id)
        );

CREATE TABLE Game (
        id SERIAL PRIMARY KEY,
        league INTEGER NOT NULL,
        home_team INTEGER NOT NULL,
        away_team INTEGER NOT NULL,
        home_goals INTEGER NOT NULL,
        away_goals INTEGER NOT NULL,
        FOREIGN KEY(league) REFERENCES League(id),
        FOREIGN KEY(home_team) REFERENCES Team(id),
        FOREIGN KEY(away_team) REFERENCES Team(id)
        );
