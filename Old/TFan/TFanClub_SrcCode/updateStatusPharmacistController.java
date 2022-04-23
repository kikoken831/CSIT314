package tFanClubProject;

public class updateStatusPharmacistController {
	
	Pharmacist user = new Pharmacist();

	//Get info to update the pres status
	public String[] passPrescriptionInfo (String token) {
		
		String[] result = null;
		
		result  = user.retrievePrescriptionStatus(token);
		
		return result;
	}
	
	//Update the prescription table
	public boolean updatePrescriptionInfo(String token, String dateDispensed, String presStatus, String pharmaID) {
		if (user.updatePrescriptionInfo(token, dateDispensed, presStatus, pharmaID)) {
			return true;
		} else {
			return false;
		}
	}
}
