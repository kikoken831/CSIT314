package tFanClubProject;

import javax.swing.JOptionPane;

public class updateUserAdminController {
	
	//Retrieve password from userInfo table and data from admin table
	public String[] retrieveAdminAcc(String username) {
		Admin adminDB = new Admin();
		String[] adminAccInfo  = adminDB.retrieveAdminInfo(username);
		return adminAccInfo;
	}
	
	//Update admin table  
	public boolean updateAdminAcc(String username, char[] password, String FName, String LName) {
		Admin adminDB = new Admin();
		if (adminDB.updateAdminAcc(username, password, FName, LName) == true) {
			return true;
		} else {
			return false;
		}
	}
	
	//Retrieve password from userInfo table and data from doctor table
	public String[] retrieveDoctorAcc(String username){
		Admin adminDB = new Admin();
		String[] doctorAccInfo  = adminDB.retrieveDoctorInfo(username);
		return doctorAccInfo;
	}
	
	//Update doctor table  
	public boolean updateDoctorAcc(String username, char[] password, String FName, String LName, int patientID) {
		Admin adminDB = new Admin();
		boolean patientExists = adminDB.checkPatientID(patientID);
		
		if(patientExists == false) {
			JOptionPane.showMessageDialog(null, "Patient with this patient ID does not exist");
			return false;
		}
		else {
			adminDB.updateDoctorAcc(username, password, FName, LName, patientID);
			return true;
		}
	}
	
	//Retrieve password from userInfo table and data from patient table
	public String[] retrievePatientAcc(String username){
		Admin adminDB = new Admin();
		String[] patientAccInfo  = adminDB.retrievePatientInfo(username);
		return patientAccInfo;
	}
	
	//Update patient table  
	public boolean updatePatientAcc(String username, char[] password, String FName, String LName, String dob, String email) {
		Admin adminDB = new Admin();
		if (adminDB.updatePatientAcc(username, password, FName, LName, dob, email) == true) {
			return true;
		} else {
			return false;
		}
	}
	
	//Retrieve password from userInfo table and data from pharmacist table
	public String[] retrievePharmacistAcc(String username){
		Admin adminDB = new Admin();
		String[] pharmacistAccInfo  = adminDB.retrievePharmacistInfo(username);
		return pharmacistAccInfo;
	}
	
	//Update pharmacist table  
	public boolean updatePharmacistAcc(String username, char[] password, String pharmaName) {
		Admin adminDB = new Admin();
		if (adminDB.updatePharmacistAcc(username, password, pharmaName) == true) {
			return true;
		} else {
			return false;
		}
	}
	
}
