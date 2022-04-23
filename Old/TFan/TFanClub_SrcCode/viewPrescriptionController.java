package tFanClubProject;

public class viewPrescriptionController 
{
	Patient patientInfo = new Patient();

	public String passPatientFullName (String username) 
	{
		String fullname  = patientInfo.getPatientName(username);
		return fullname;
	}
	public String [][] getPrescription(String accountUsername, int prescriptionID)
	{
		int patientID = patientInfo.getPatientID(accountUsername);
		return patientInfo.getPrescription(patientID, prescriptionID);
	}
	public String [] getInfo(String username, int prescriptionID)
	{
		
		return patientInfo.getInfo(patientInfo.getPatientID(username), prescriptionID);
	}
}
