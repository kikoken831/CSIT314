package tFanClubProject;

public class viewPrescriptionListController
{
	public String [][] getPrescriptions(String accountUsername)
	{
		Patient patientData = new Patient ();
		int patientID = patientData.getPatientID(accountUsername);
	
		return patientData.getPres(patientID);
	}
	
	Patient patientInfo = new Patient();

	public String passPatientFullName (String username) 
	{
		String fullname  = patientInfo.getPatientName(username);
		return fullname;
	}
	
	public boolean checkPrescription(String username, int prescriptionID)
	{
		int patientID = patientInfo.getPatientID(username);
		return patientInfo.checkPrescription(patientID, prescriptionID);
	}
}
