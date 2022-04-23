package tFanClubProject;

import java.sql.Connection;
import java.sql.DriverManager;

public class ConnectDatabase {
	static Connection conn = null;

	static Connection getConnection() {
		try {
			Class.forName("org.sqlite.JDBC");
			conn = DriverManager.getConnection("jdbc:sqlite:DatabaseFiles/userInfo_3.db");
		} catch (Exception e) {
			e.printStackTrace();
		}
		return conn;
	}
}
