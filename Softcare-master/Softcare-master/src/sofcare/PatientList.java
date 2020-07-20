/*
Softcare Information System
TINFO 360 B
Bikramjeet Ghura, Sheikh Jobe, Julian Galvan, Joe Phouapha
 */
package sofcare;

/**
 *
 * @author Bikramjeet
 */
import java.awt.BorderLayout;
import java.awt.Window;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.swing.DefaultListModel;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JList;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.SwingUtilities;

// This is the class for the Patient List generated based on the PatientList.txt
// file.
public class PatientList extends JPanel{
    JList list;
    DefaultListModel model;
    
    // Patient List object
  public PatientList() {
    setLayout(new BorderLayout());
    model = new DefaultListModel();
    list = new JList(model);
    JScrollPane pane = new JScrollPane(list);
    JButton submitButton = new JButton("Select");
    JButton newPButton = new JButton("New Patient");
    JButton exitButton = new JButton("Logout");
    getPatients();
    
    // Opens the Admissions or ADL form of the selected patient based on 
    // employee type.
    submitButton.addActionListener(new ActionListener() {
      public void actionPerformed(ActionEvent e) {
          String patient = list.getSelectedValue().toString();
          String pID = patient.substring(0, (patient.indexOf("-")));
          if(Employee.UserType.equals("AN")) {
              new Patient().setVisible(true);
              Patient.loadPatient(pID);          
          } else {
              new ADLChart().setVisible(true);
              ADLChart.loadADL(pID);
          }
            Window w = SwingUtilities.getWindowAncestor(pane);
            w.setVisible(false);
      }
    });
    
    // Opens admission form to add a new patient.
    newPButton.addActionListener(new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            Window w = SwingUtilities.getWindowAncestor(pane);
            w.setVisible(false);
            new Patient().setVisible(true);
        }
    }); 
    
    // Takes back to login page
    exitButton.addActionListener(new ActionListener() {
      public void actionPerformed(ActionEvent e) {
            Window w = SwingUtilities.getWindowAncestor(pane);
            w.setVisible(false);
          new Employee().setVisible(true);
      }
    });
    
    add(pane, BorderLayout.NORTH);
    add(submitButton, BorderLayout.WEST);
    if(Employee.UserType.equals("AN")) {
        add(newPButton);
    }
    add(exitButton, BorderLayout.EAST);
  }
  
  // Reads list of patients from AllPatients.txt
  public void getPatients() {
       Scanner console = null;
        try {
            console = new Scanner(new File("/Users/Bikramjeet/Documents/UW/Aut2016/TINFO360/Softcare/Updated/SofcareProject/SofCare/DataFiles/AllPatients.txt"));
        } catch (FileNotFoundException ex) {
            Logger.getLogger(PatientList.class.getName()).log(Level.SEVERE, null, ex);
        }
        while(console.hasNextLine()) {
            model.addElement(console.nextLine());
        }
        console.close();
    }
    
    // Generates the select patient GUI
    public static void viewScreen(){
        JFrame frame = new JFrame("Select Patient");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setContentPane(new PatientList());
        frame.setSize(260, 200);
        frame.setVisible(true);
    }
    
    // Checks if the given patient ID exists
    public boolean checkExist(String id) {
        for(int i = 0; i < model.getSize() - 1; i++) {
            String listId = model.elementAt(i).toString();
            if(id.equals(listId.substring(0, listId.indexOf("-")))) {
                return true;
            }
        }
        return false;
    }
   
  public static void main(String s[]) {
    viewScreen();
  }
}
