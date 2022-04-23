package tFanClubProject;

public class homePagePatientController 
{

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
