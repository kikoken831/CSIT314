package tFanClubProject;

import javax.swing.JOptionPane;

public class addUserAdminController {

	public boolean addUserAdmin(String username, char[] password, String FName, String LName) {
		Admin adminDB = new Admin();
		boolean isThereDuplicate = adminDB.checkDuplicate(username);
		
		if (isThereDuplicate == true) {
			JOptionPane.showMessageDialog(null, "Duplicate username");
			return false;
		}
		else {
			String role = "Admin";
			Admin admin = new Admin();
			admin.addAdmin(username, FName, LName);
			admin.addUserInfo(username, password, role);
			return true;
		}
	}
	
	public boolean addUserPatient(String username, char[] password, String FName, String LName, String date, String email) {
		Admin adminDB = new Admin();
		boolean isThereDuplicate = adminDB.checkDuplicate(username);
		
		if (isThereDuplicate == true) {
			JOptionPane.showMessageDialog(null, "Duplicate username");
			return false;
		}
		else {
			String role = "Patient";
			Admin admin = new Admin();
			admin.addPatient(username, FName, LName, date, email);
			admin.addUserInfo(username, password, role);
			return true;
		}
	}
	
	public boolean addUserPharmacist(String username, char[] password, String pharmaName) {
		Admin adminDB = new Admin();
		boolean isThereDuplicate = adminDB.checkDuplicate(username);
		
		if (isThereDuplicate == true) {
			JOptionPane.showMessageDialog(null, "Duplicate username");
			return false;
		}
		else {
			String role = "Pharmacist";
			Admin admin = new Admin();
			admin.addPharmacist(username, pharmaName);
			admin.addUserInfo(username, password, role);
			return true;
		}
	}
	
	public boolean addUserDoctor(String username, char[] password, String FName,String LName, int patientID) {
		Admin adminDB = new Admin();
		boolean isThereDuplicate = adminDB.checkDuplicate(username);
		boolean patientExists = adminDB.checkPatientID(patientID);
		
		if (isThereDuplicate == true) {
			JOptionPane.showMessageDialog(null, "Duplicate username");
			return false;
		}
		else if(patientExists == false) {
			JOptionPane.showMessageDialog(null, "Patient with this patient ID does not exist");
			return false;
		}
		else {
			String role = "Doctor";
			Admin admin = new Admin();
			admin.addDoctor(username, FName, LName, patientID);
			admin.addUserInfo(username, password, role);
			return true;
		}
	}
	
}
