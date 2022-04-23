package tFanClubProject;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.swing.JOptionPane;


public class Patient 
{
	/*Connection code*/
	Connection connection = null;
	Connection conn = null;
	
	//Establish connection with the database
	public static Connection dbConnector() 
	{
		try 
		{
			Class.forName("org.sqlite.JDBC");
			//Set this path to where  you put your database file in your computer
			Connection conn = DriverManager.getConnection("jdbc:sqlite:DatabaseFiles/userInfo_3.db");
			return conn;
		}
		catch(Exception e) 
		{
			JOptionPane.showMessageDialog(null, e);
			return null;
		}
	}
	
	public String getPatientName(String username)
	{
		String fullName = null;
		try {

			connection = dbConnector();
			
			//hi
			String query = "SELECT patientFName , patientLName FROM Patient where username = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setString(1, username);
			
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while(rs.next()) {
				fullName = rs.getString("patientFName") + (" ")+ rs.getString("patientLName");
			}
		}
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
		}
		return fullName;
	}

	public int getPatientID(String username)
	{
		int patientID = 0;
		try 
		{
			connection = dbConnector();
			String query = "SELECT patientID FROM Patient WHERE username = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setString(1, username);
			//This gets the values back one by one from the database
			ResultSet rs = pst.executeQuery();
			while (rs.next())
			{
				patientID = rs.getInt("patientID");
			}
			connection.close();
			rs.close();
			return patientID;
		}
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return patientID;
		}
	}
	
	public int getCountPres(int patientID) 
	{
		int counter = 0;
		try 
		{
			connection = dbConnector();
			String query = "SELECT * FROM Prescription WHERE PatientID = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setInt(1, patientID);
			//This gets the values back one by one from the database
			ResultSet rscount = pst.executeQuery();
			while(rscount.next()) 
			{
				counter = counter + 1;
			}
			connection.close();
			rscount.close();
			return counter;
		}
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return counter;
		}
	}
	public String [][] getPres(int patientID)
	{
		int counter = getCountPres(patientID);
		String [][] presList= new String [counter][3];
		counter = 0; // reset to use to store data in 2Darray
		try 
		{
			connection = dbConnector();
			String query = "SELECT presNum, datePrescribed, presStatus FROM Prescription WHERE patientID = ? ORDER BY presStatus";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setInt(1, patientID);
			//This gets the values back one by one from the database
			ResultSet rspres = pst.executeQuery();
			while(rspres.next()) 
			{
				String presNum = String.valueOf(rspres.getInt("presNum"));
				String presDate = formatDate(rspres.getString("datePrescribed"));
				String presStatus = rspres.getString("presStatus");
				presList [counter][0] = presNum;
				presList [counter][1] = presDate;
				presList [counter][2] = presStatus;
				counter += 1;
			}
			connection.close();
			rspres.close();
			return presList;
		}  
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return presList;
		}
	}
	
	// get data of a particular prescriptions
	public String [][] getPrescription(int patientID, int prescriptionID)
	{
		String [][] presList= new String [1][2];
		try
		{
			connection = dbConnector();
			String query = "SELECT medicationName, dosage FROM Prescription WHERE patientID = ? AND presNum = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setInt(1, patientID);
			pst.setInt(2, prescriptionID);
			//This gets the values back one by one from the database
			ResultSet rspres = pst.executeQuery();
			while(rspres.next()) 
			{
				String medication = rspres.getString("medicationName");
				String dosage = String.valueOf(rspres.getInt("dosage"));
				
				presList [0][0] = medication;
				presList [0][1] = dosage;
				
			}
			connection.close();
			rspres.close();
			return presList;
		}  
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return presList;
		}
	}
	
	// check if prescription belong to the patient
	public boolean checkPrescription (int patientID, int prescriptionID)
	{
		int counter = 0;
		try {
			connection = dbConnector();
			String query = "SELECT * FROM Prescription WHERE patientID = ? AND presNum = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setInt(1, patientID);
			pst.setInt(2, prescriptionID);
			ResultSet rspres = pst.executeQuery();
			while(rspres.next()) 
			{
				counter +=1;
			}
			connection.close();
			rspres.close();
			if (counter == 1)
				return true;
			else return false;
		}
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return false;
		}
	}
	
	public String [] getInfo(int patientID, int prescriptionID)
	{
		String [] info = new String[2];
		try {
			connection = dbConnector();
			String query = "SELECT datePrescribed, presStatus FROM Prescription WHERE patientID = ? AND presNum = ?";
			PreparedStatement pst = connection.prepareStatement(query);
			pst.setInt(1, patientID);
			pst.setInt(2, prescriptionID);
			ResultSet rspres = pst.executeQuery();
			while(rspres.next()) 
			{
				info[0] = formatDate(rspres.getString("datePrescribed"));
				info[1] = rspres.getString("presStatus");
			}
			connection.close();
			rspres.close();
			return info;
		}
		catch(Exception f) 
		{
			JOptionPane.showMessageDialog(null, f);
			return info;
		}
	}
	public String formatDate(String date)
	{
		String output = "";
		for (int i = 0; i < date.length(); i++)
		{
		    char c = date.charAt(i);
		    if (i == 2)
		    	output = output + '-' + c ;
		    else if (i == 4)
		    	output = output + '-' + c ;
		    else 
		    	output = output + c;
		}
		return output;
	}
}
