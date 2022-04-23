package tFanClubProject;

import java.sql.*;
import javax.swing.*;

public class UserInfo {
	
	/*Connection code*/
	Connection connection = null;
	Connection conn = null;
	
	//Establish connection with the database
	public static Connection dbConnector() {
		
		try {
			Class.forName("org.sqlite.JDBC");
			//Set this path to where  you put your database file in your computer
			Connection conn = DriverManager.getConnection("jdbc:sqlite:DatabaseFiles/userInfo_3.db");
			return conn;
		}
		catch(Exception e) {
			JOptionPane.showMessageDialog(null, e);
			return null;
		}
		
	}
	
	
	//For login page
	public String validateInfo(String username, char[] password) {
		String loginResult = null;
	try {

		connection = dbConnector();
		//Convert hidden char to string
		String pass = String.valueOf(password);
		
		//userInfo is the name of the SQLite database, username and password are the fields
		String query = "SELECT role FROM userInfo where Username=? and Password=?";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setString(1, username);
		pst.setString(2, pass);
		//This gets the values back one by one from the database
		ResultSet rs = pst.executeQuery();

		while(rs.next()) {
			loginResult = rs.getString("role");
		}
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
	}
	return loginResult;
	}
	
	//For homepage
	public String getHomepageInfo(String username) {
		String fullName = null;
	try {

		connection = dbConnector();
		
		//hi
		String query = "SELECT adminFName , adminLName FROM Admin where username = ?";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setString(1, username);
		
		//This gets the values back one by one from the database
		ResultSet rs = pst.executeQuery();
		while(rs.next()) {
			fullName = rs.getString("adminFName") + (" ")+ rs.getString("adminLName");
		}
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
	}
	return fullName;
	}
	
	
	
	
}
