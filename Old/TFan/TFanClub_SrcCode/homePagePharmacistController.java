package tFanClubProject;

import java.util.ArrayList;
import java.util.List;

public class homePagePharmacistController {

	Pharmacist user = new Pharmacist();

	public String passPharmacistHomepageInfo (String fullname) {
		
		String result = null;
		
		result  = user.getHomepageInfo(fullname);
		
		return result;
	}
	
	public String getPharmacistID (String username) {
		
		String id = null;
		
		id  = user.getPharmaID(username);
		
		return id;
	}
	
	public List<String> getPrescription(int patientID) {
		
		List<String> prescriptionInfo = new ArrayList<String>();
		
		prescriptionInfo  = user.retrievePrescriptions(patientID);
		
		return prescriptionInfo;
	}
}
