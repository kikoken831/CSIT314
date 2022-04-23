package tFanClubProject;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.swing.JOptionPane;

public class Admin {
	
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
	
	//Verify existing record
	public boolean checkDuplicate (String username) {
	try {

		connection = dbConnector();
		
		//userInfo is the name of the SQLite database, username and password are the fields
		String query = "SELECT * FROM userInfo where Username=?";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setString(1, username);
		
		//This gets the values back one by one from the database
		ResultSet rs = pst.executeQuery();
		int count = 0;
		while(rs.next()) {
			count = count + 1;
		}
		
		if (count >= 1) {
			connection.close();
			rs.close();
			return true;
			
		}
		else {
			connection.close();
			rs.close();
			return false;
		}
		
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
		return true;
	}
	}
	
	//Gets the row count in admin table
	public int getCountAdmin() {
		int count = 0;
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Admin";
			PreparedStatement pst = connection.prepareStatement(query);
			
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				count = count + 1;
			}
			connection.close();
			rs.close();
			return count;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return count;
		}
	}
	
	//Add account to admin database
	public void addAdmin (String username, String FName, String LName) {
	try {
		int numOfRows = getCountAdmin() + 1;
		connection = dbConnector();

		//Inserts the data
		String query = "INSERT INTO Admin(adminID, username, adminFName, adminLName) VALUES (?,?,?,?)";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setInt(1, numOfRows);
		pst.setString(2, username);
		pst.setString(3, FName);
		pst.setString(4, LName);

		pst.executeUpdate();
		pst.close();
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
	}
	}
	
	//Gets the row count in patient table
	public int getCountPatient() {
		int count = 0;
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Patient";
			PreparedStatement pst = connection.prepareStatement(query);
			
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				count = count + 1;
			}
			connection.close();
			rs.close();
			return count;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return count;
		}
	}
	
	//Add account to patient database
	public void addPatient (String username, String FName, String LName, String DOB, String email) {
	try {
		int numOfRows = getCountPatient() + 1;
		connection = dbConnector();
		
		//Inserts the data
		String query = "INSERT INTO Patient(patientID, username, patientFName, patientLName, patientDOB, patientEmail) VALUES (?,?,?,?,?,?)";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setInt(1, numOfRows);
		pst.setString(2, username);
		pst.setString(3, FName);
		pst.setString(4, LName);
		pst.setString(5, DOB);
		pst.setString(6, email);

		pst.executeUpdate();
		pst.close();
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
	}
	}
	
	//Gets the row count in patient table
	public int getCountPharmacist() {
		int count = 0;
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Pharmacist";
			PreparedStatement pst = connection.prepareStatement(query);
			
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				count = count + 1;
			}
			connection.close();
			rs.close();
			return count;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return count;
		}
	}
	
	//Add account to pharmacist database
	public void addPharmacist (String username, String FName) {
	try {
		int numOfRows = getCountPharmacist() + 1;
		connection = dbConnector();
		
		//Inserts the data
		String query = "INSERT INTO Pharmacist(pharamcistID, username, pharmaName) VALUES (?,?,?)";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setInt(1, numOfRows);
		pst.setString(2, username);
		pst.setString(3, FName);

		pst.executeUpdate();
		pst.close();
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
	}
	}
	
	//Gets the row count in doctor table
	public int getCountDoctor() {
		int count = 0;
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Doctor";
			PreparedStatement pst = connection.prepareStatement(query);
			
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				count = count + 1;
			}
			connection.close();
			rs.close();
			return count;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return count;
		}
	}
	
	//Add account to doctor database
	public void addDoctor (String username, String FName, String LName, int patientID) {
	try {
		int numOfRows = getCountDoctor() + 1;
		connection = dbConnector();
		
		//Inserts the data
		String query = "INSERT INTO Doctor(doctorID, username, doctorFName, doctorLName, patientID) VALUES (?,?,?,?,?)";
		PreparedStatement pst = connection.prepareStatement(query);
		pst.setInt(1, numOfRows);
		pst.setString(2, username);
		pst.setString(3, FName);
		pst.setString(4, LName);
		pst.setLong(5, patientID);

		pst.executeUpdate();
		pst.close();
	}
	catch(Exception f) {
		JOptionPane.showMessageDialog(null, f);
		}
	}
	
	//Check if theres a patient with this patient ID (When adding doctor)
	public boolean checkPatientID(int patientID) {
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Patient where patientID=?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setLong(1, patientID);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			int count = 0;
			while(rs.next()) {
				count = count + 1;
			}
			if (count >= 1) {
				connection.close();
				rs.close();
				return true;
			}
			else {
				connection.close();
				rs.close();
				return false;
			}
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return true;
		}
	}

	
	//Adds account into userInfo database so they can login
	public void addUserInfo (String username, char[] password, String role) {
		try {
		connection = dbConnector();
		String pass = String.valueOf(password);
		
		//Inserts the data
		String query = "INSERT INTO userInfo(username, password, role) VALUES (?,?,?)";
		PreparedStatement pst = connection.prepareStatement(query);

		pst.setString(1, username);
		pst.setString(2, pass);
		pst.setString(3, role);

		pst.executeUpdate();
		pst.close();
		} 
		catch(Exception f){
			JOptionPane.showMessageDialog(null, f);
		}
	}

	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	//Methods regarding updating of user are below
	
	//Only retrieves info according to username from userinfo and admin table
	public String[] retrieveAdminInfo (String username) {
		String adminData[] = new String[3];
		try {
			connection = dbConnector();
			String query = "SELECT password FROM userInfo where username=?";
			String query2 = "SELECT adminFName , adminLName FROM Admin where username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst.setString(1, username);
			pst2.setString(1, username);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				adminData[0] = rs.getString("password");
			}
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				adminData[1] = rs2.getString("adminFName");
				adminData[2] = rs2.getString("adminLName");
			}
			
			if (adminData[1] == null || adminData[2] == null) {
				return null;
			}	
			
			else {
				return adminData;
			}
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Updates admin and userinfo database
	public boolean updateAdminAcc (String username, char[] password, String FName, String LName) {
		try {
		connection = dbConnector();
		String pass = String.valueOf(password);
		
		//Updates data in userInfo
		String query = "UPDATE userInfo SET password=? WHERE username=?";
		//Updates data in Admin
		String query2 = "UPDATE Admin SET adminFName=? , adminLName =? WHERE username=?";
		PreparedStatement pst = connection.prepareStatement(query);
		PreparedStatement pst2 = connection.prepareStatement(query2);

		pst.setString(1, pass);
		pst.setString(2, username);
		pst.executeUpdate();
		pst.close();
		
		pst2.setString(1, FName);
		pst2.setString(2, LName);
		pst2.setString(3, username);
		pst2.executeUpdate();
		pst2.close();
		
		return true;
		} 
		catch(Exception f){
			JOptionPane.showMessageDialog(null, f);
			return false;
		}
	}
	
	//Get doctor info
	public String[] retrieveDoctorInfo (String username) {
		String doctorInfo[] = new String[5];
		try {
			connection = dbConnector();
			String query = "SELECT password FROM userInfo where username=?";
			String query2 = "SELECT doctorFName , doctorLName, patientID FROM Doctor where username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst.setString(1, username);
			pst2.setString(1, username);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				doctorInfo[0] = rs.getString("password");
			}
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				doctorInfo[1] = rs2.getString("doctorFName");
				doctorInfo[2] = rs2.getString("doctorLName");
				doctorInfo[3] = rs2.getString("patientID");
			}
			
			if (doctorInfo[1] == null || doctorInfo[2] == null || doctorInfo[3] == null) {
				return null;
			}	
			
			else {
				return doctorInfo;
			}
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Update doctor info
	public boolean updateDoctorAcc(String username, char[] password, String FName, String LName, int patientID) {
		try {
			connection = dbConnector();
			String pass = String.valueOf(password);
			
			//Updates data in userInfo
			String query = "UPDATE userInfo SET password=? WHERE username=?";
			//Updates data in Admin
			String query2 = "UPDATE Doctor SET doctorFName=? , doctorLName=? , patientID=? WHERE username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);

			pst.setString(1, pass);
			pst.setString(2, username);
			pst.executeUpdate();
			pst.close();
			
			pst2.setString(1, FName);
			pst2.setString(2, LName);
			pst2.setInt(3, patientID);
			pst2.setString(4, username);
			pst2.executeUpdate();
			pst2.close();
			
			return true;
			} 
			catch(Exception f){
				JOptionPane.showMessageDialog(null, f);
				return false;
			}
	}
	
	
	//Get patient info
	public String[] retrievePatientInfo (String username) {
		String patientInfo[] = new String[5];
		try {
			connection = dbConnector();
			String query = "SELECT password FROM userInfo where username=?";
			String query2 = "SELECT patientFName , patientLName, patientDOB, patientEmail FROM Patient where username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst.setString(1, username);
			pst2.setString(1, username);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				patientInfo[0] = rs.getString("password");
			}
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				patientInfo[1] = rs2.getString("patientFName");
				patientInfo[2] = rs2.getString("patientLName");
				patientInfo[3] = rs2.getString("patientDOB");
				patientInfo[4] = rs2.getString("patientEmail");
			}
			
			if (patientInfo[1] == null || patientInfo[2] == null || patientInfo[3] == null || patientInfo[4] == null) {
				return null;
			}	
			
			else {
				return patientInfo;
			}
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Update patient info
	public boolean updatePatientAcc(String username, char[] password, String FName, String LName, String dob, String email) {
		try {
			connection = dbConnector();
			String pass = String.valueOf(password);
			
			//Updates data in userInfo
			String query = "UPDATE userInfo SET password=? WHERE username=?";
			//Updates data in Admin
			String query2 = "UPDATE Patient SET patientFName=? , patientLName=? , patientDOB=? , patientEmail=? WHERE username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);

			pst.setString(1, pass);
			pst.setString(2, username);
			pst.executeUpdate();
			pst.close();
			
			pst2.setString(1, FName);
			pst2.setString(2, LName);
			pst2.setString(3, dob);
			pst2.setString(4, email);
			pst2.setString(5, username);
			pst2.executeUpdate();
			pst2.close();
			
			return true;
			} 
			catch(Exception f){
				JOptionPane.showMessageDialog(null, f);
				return false;
			}
	}
	
	//Get pharmacist info
	public String[] retrievePharmacistInfo (String username) {
		String pharmacistInfo[] = new String[3];
		try {
			connection = dbConnector();
			String query = "SELECT password FROM userInfo where username=?";
			String query2 = "SELECT pharmaName FROM Pharmacist where username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst.setString(1, username);
			pst2.setString(1, username);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				pharmacistInfo[0] = rs.getString("password");
			}
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				pharmacistInfo[1] = rs2.getString("pharmaName");
			}
			
			if (pharmacistInfo[1] == null) {
				return null;
			}	
			
			else {
				return pharmacistInfo;
			}
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Update pharmacist info
	public boolean updatePharmacistAcc(String username, char[] password, String pharmaName) {
		try {
			connection = dbConnector();
			String pass = String.valueOf(password);
			
			//Updates data in userInfo
			String query = "UPDATE userInfo SET password=? WHERE username=?";
			//Updates data in Admin
			String query2 = "UPDATE Pharmacist SET pharmaName=? WHERE username=?";
			PreparedStatement pst = connection.prepareStatement(query);
			PreparedStatement pst2 = connection.prepareStatement(query2);

			pst.setString(1, pass);
			pst.setString(2, username);
			pst.executeUpdate();
			pst.close();
			
			pst2.setString(1, pharmaName);
			pst2.executeUpdate();
			pst2.close();
			
			return true;
			} 
			catch(Exception f){
				JOptionPane.showMessageDialog(null, f);
				return false;
			}
	}
	
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	//Methods regarding searching of users are below
	
	//Get admin username
	public String getAdminUsername (int userID) {
		String username = null;
		try {
			connection = dbConnector();
			String query2 = "SELECT username FROM Admin where adminID=?";
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst2.setInt(1, userID);
			//This gets the values back one by one from the database
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				username = rs2.getString("username");
			}
			return username;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Get doctor username
	public String getDoctorUsername (int userID) {
		String username = null;
		try {
			connection = dbConnector();
			String query2 = "SELECT username FROM Doctor where doctorID=?";
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst2.setInt(1, userID);
			//This gets the values back one by one from the database
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				username = rs2.getString("username");
			}
			return username;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Get patient username
	public String getPatientUsername (int userID) {
		String username = null;
		try {
			connection = dbConnector();
			String query2 = "SELECT username FROM Patient where patientID=?";
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst2.setInt(1, userID);
			//This gets the values back one by one from the database
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				username = rs2.getString("username");
			}
			return username;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
	
	//Get admin username
	public String getPharmacistUsername (int userID) {
		String username = null;
		try {
			connection = dbConnector();
			String query2 = "SELECT username FROM Pharmacist where pharmacistID=?";
			PreparedStatement pst2 = connection.prepareStatement(query2);
			pst2.setInt(1, userID);
			//This gets the values back one by one from the database
			ResultSet rs2 = pst2.executeQuery();
			while(rs2.next()) {
				username = rs2.getString("username");
			}
			return username;
		}
		catch(Exception f) {
			JOptionPane.showMessageDialog(null, f);
			return null;
		}
	}
}
