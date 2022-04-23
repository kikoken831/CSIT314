package tFanClubProject;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import javax.swing.table.TableModel;

public class doctorInfoController {

	public void sendEmail(String title, String to, String body) {

		// Sender's email ID needs to be mentioned
		String from = "tfanclub369@gmail.com";
		String pass = "tfanclub123";
		// Recipient's email ID needs to be mentioned.

		// REMOVE THIS
		to = "tfanclub369@gmail.com";

		String host = "smtp.gmail.com";

		// Get system properties
		Properties properties = System.getProperties();
		// Setup mail server
		properties.put("mail.smtp.starttls.enable", "true");
		properties.put("mail.smtp.host", host);
		properties.put("mail.smtp.user", from);
		properties.put("mail.smtp.password", pass);
		properties.put("mail.smtp.port", "587");
		properties.put("mail.smtp.auth", "true");
		properties.put("mail.smtp.ssl.trust", "smtp.gmail.com");
		properties.put("mail.smtp.ssl.protocols", "TLSv1.2");

		// Get the default Session object.
		Session session = Session.getDefaultInstance(properties);

		try {
			// Create a default MimeMessage object.
			MimeMessage message = new MimeMessage(session);

			// Set From: header field of the header.
			message.setFrom(new InternetAddress(from));

			// Set To: header field of the header.
			message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));

			// Set Subject: header field
			message.setSubject(title);

			// Now set the actual message
			message.setText(body);

			// Send message
			Transport transport = session.getTransport("smtp");
			transport.connect(host, from, pass);
			transport.sendMessage(message, message.getAllRecipients());
			transport.close();
			System.out.println("Sent message successfully....");
		} catch (MessagingException mex) {
			mex.printStackTrace();
		}
	}

	private String generateToken(int n) {
		String AlphaNumericString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ" + "0123456789" + "abcdefghijklmnopqrstuvxyz";

		// create StringBuffer size of AlphaNumericString
		StringBuilder sb = new StringBuilder(n);

		for (int i = 0; i < n; i++) {

			// generate a random number between
			// 0 to AlphaNumericString variable length
			int index = (int) (AlphaNumericString.length() * Math.random());

			// add Character one by one in end of sb
			sb.append(AlphaNumericString.charAt(index));
		}
		return sb.toString();

	}

	public String addPrescription(int patientId, ArrayList<String> datePrescribedArrayList,
			ArrayList<String> medicationArrayList, int docID, ArrayList<String> dosageArrayList) throws SQLException {
		String token = generateToken(10);

		Doctor doc1 = new Doctor();
		for (int i = 0; i < datePrescribedArrayList.size(); i++) {
			String datePrescribed = datePrescribedArrayList.get(i);
			String medication = medicationArrayList.get(i);
			String dosage = dosageArrayList.get(i);

			doc1.addPrescription(patientId, datePrescribed, medication, docID, dosage, token);
		}

		TableModel patientDetails = doc1.getPatientEmail(patientId);

		String medicationDetails = "";
		for (int i = 0; i < medicationArrayList.size(); i++) {
			medicationDetails += medicationArrayList.get(i) + ",";
		}
		medicationDetails = medicationDetails.substring(0, medicationDetails.length() - 1);
		String patientFName = (String) patientDetails.getValueAt(0, 1);

		String to = (String) patientDetails.getValueAt(0, 0);
		String title = "Prescription Details";
		String body = "Hello " + patientFName + ",\n\nYour prescription for " + medicationDetails
				+ " is ready for collection. Please proceed to the pharmacy and show this token: " + token
				+ "\n\nYours Sincerely,\ntFanClub Hospital";

		sendEmail(title, to, body);

		return null;

	}

	public TableModel getPatientInfo(int patientId) throws SQLException {
		Doctor doc1 = new Doctor();
		TableModel username = doc1.getPatientInfo(patientId);
		return username;
	}

	public int getDoctorID(String username) throws SQLException {
		Doctor doc1 = new Doctor();
		int doctorId = doc1.getDoctorID(username);
		return doctorId;

	}

	public TableModel getPrescription(int patientId, String text) throws SQLException {
		Doctor doc1 = new Doctor();
		TableModel pres = doc1.getPrescription(patientId, text);
		return pres;
	}

	public static String getPatientName(int patientId) throws SQLException {
		Doctor doc1 = new Doctor();
		String doctorId = doc1.getPatientName(patientId);
		return doctorId;
	}

	public int updateToken(int patientId) throws SQLException {
		Doctor doc1 = new Doctor();
		int response = doc1.updateToken(patientId);
		return response;

	}

}
