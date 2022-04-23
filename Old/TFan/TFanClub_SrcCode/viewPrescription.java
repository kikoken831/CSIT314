package tFanClubProject;

import java.awt.BorderLayout;
import java.awt.EventQueue;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.SwingConstants;
import javax.swing.border.EmptyBorder;
import net.miginfocom.swing.MigLayout;
import javax.swing.JCheckBox;

public class viewPrescription extends JFrame 
{

	private JPanel contentPane;
	private JTable table;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) 
	{
		EventQueue.invokeLater(new Runnable() 
		{
			public void run() 
			{
				try 
				{
					String username = null;
					int prescriptionID = 0;
					viewPrescription frame = new viewPrescription(username, prescriptionID);
					frame.setVisible(true);
				}
				catch (Exception e) 
				{
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public viewPrescription(String username, int prescriptionID) 
	{
		
		String accountUsername = username;
		
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 646, 376);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new MigLayout("", "[55px,grow][][grow][][][][][][][][][][][][][][][][][][][][]", "[23px][grow][][][][][][][][][][][][][][][][][]"));
		
		// Logout button
		JButton btnLogout = new JButton("Logout");
		btnLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame loginPage = new LoginPage();
				loginPage.setVisible(true);
				
				dispose();
			}
		});
		btnLogout.setBounds(335, 11, 89, 23);
		contentPane.add(btnLogout, "cell 21 2");
		
		// home button
		JButton btnHome = new JButton("Home");
		btnHome.setHorizontalAlignment(SwingConstants.RIGHT);
		btnHome.addActionListener(new ActionListener() 
		{
			public void actionPerformed(ActionEvent e) 
			{
				JFrame homepage = new homePagePatient(accountUsername);
				homepage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnHome, "cell 20 2,alignx left,aligny top");
		
		
		getTable(accountUsername, prescriptionID);
		
	}
	
	public void getTable(String accountUsername, int prescriptionID)
	{


			viewPrescriptionController vPC = new viewPrescriptionController(); 
			
			// User Info label
			String fullName = vPC.passPatientFullName(accountUsername);
			JLabel patientLabel = new JLabel("Patient: ");
			contentPane.add(patientLabel, "flowx,cell 9 2");
			JLabel patientName = new JLabel(fullName);
			contentPane.add(patientName, "cell 9 2");
			
			
			String [] details = vPC.getInfo(accountUsername, prescriptionID);
			JLabel dateDispensedL = new JLabel("Date dispensed:");
			contentPane.add(dateDispensedL, "flowx,cell 9 3");
			
			JLabel statusL = new JLabel("Status: ");
			contentPane.add(statusL, "flowx,cell 9 4");
			// data table
	
			String [] columnNames = {"Medicine", "Dosage"};
			String [][] data = vPC.getPrescription(accountUsername, prescriptionID);
			
			table = new JTable(data, columnNames){

		        @Override
		        public boolean isCellEditable(int row, int column)
		        {
		            // make read only fields except column 0,13,14
		            return column == 0 || column == 13 || column == 14;
		        }
		    };;
			
			table.getColumnModel().getColumn(0).setPreferredWidth(100);
			table.getColumnModel().getColumn(1).setPreferredWidth(100);
			
			JScrollPane scrollPane = new JScrollPane(table);
			contentPane.add (scrollPane, "flowx,cell 9 13");
			JLabel dateDispensed = new JLabel(details[0]);
			contentPane.add(dateDispensed, "cell 9 3");
			JLabel status = new JLabel(details[1]);
			contentPane.add(status, "cell 9 4");
	}

}
