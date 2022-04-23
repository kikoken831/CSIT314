package tFanClubProject;


import java.awt.EventQueue;


import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JTextField;
import net.miginfocom.swing.MigLayout;

public class homePagePatient extends JFrame {

	private JPanel contentPane;
	private JTextField textField;


	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					String username = null;
					homePagePatient frame = new homePagePatient(username);
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	//LoginPage passes in the username
	public homePagePatient(String username) {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 646, 376);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new MigLayout("", "[][][][][][][114px][10px][153px][][][][][][127px][][][]", "[35px][23px][23px][][][][][][][]"));
		
		//Set username to Jlabel
		homePagePatientController patientController = new homePagePatientController();
		String fullName = patientController.passPatientFullName(username);
		
		JLabel lblWelcome = new JLabel("New label");
		contentPane.add(lblWelcome, "cell 1 1,grow");
		lblWelcome.setText("Welcome patient, ");
		JLabel lblNewLabel_1 = new JLabel(fullName);
		contentPane.add(lblNewLabel_1, "flowx,cell 2 1");
		
		JButton btnLogout = new JButton("Logout");
		btnLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame loginPage = new LoginPage();
				loginPage.setVisible(true);
				
				dispose();
			}
		});
		contentPane.add(btnLogout, "cell 8 1,alignx right,aligny top");
		
		
		JLabel lblNewLabel = new JLabel("Prescription number : ");
		contentPane.add(lblNewLabel, "flowx,cell 2 5,growx,aligny center");
		
		textField = new JTextField();
		contentPane.add(textField, "cell 6 5,growx,aligny center");
		textField.setColumns(10);
		
		JButton btnSearch = new JButton("Search my prescription");
		contentPane.add(btnSearch, "cell 8 5,alignx left,aligny top");
		btnSearch.addActionListener(new ActionListener() 
		{
			public void actionPerformed(ActionEvent e) 
			{
				if (textField.getText().isEmpty())
				{
					JOptionPane.showMessageDialog(null, "Please key in the prescription ID");			
				}
				else
				{
					try
					{
						int prescriptionID = Integer.parseInt(textField.getText());

						if(patientController.checkPrescription(username, prescriptionID) == false)
						{
							JOptionPane.showMessageDialog(null, "The prescription ID entered does not belong to you or doesn't exist.");	
						}
						else 
						{
							JFrame viewPrescription = new viewPrescription(username, prescriptionID);
							viewPrescription.setVisible(true);
							dispose();	
						}
					}
					catch (NumberFormatException a)
					{
						JOptionPane.showMessageDialog(null, "Please enter an integer for the ID.");	
					}
				}
			} 
		});
		
		JButton btnNewButton = new JButton("View all prescriptions");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame viewprespage = new viewPrescriptionList(username);
				viewprespage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnNewButton, "cell 6 7,alignx left,aligny top");
		
	}
}
