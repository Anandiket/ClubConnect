<?php

// Include the TCPDF library
include('library/tcpdf.php');
include "db_connection.php";

if (isset($_GET['Event_ID'])) {
    $event_id = $_GET['Event_ID'];

    // Make sure to sanitize the input to prevent SQL injection
    $event_id = intval($event_id);


// Fetch event data from the database
$sql = "SELECT * FROM events WHERE Event_ID = $event_id";
$result = $conn->query($sql);

} else {
    echo "Event ID not provided in the URL.";
}

// Fetch the event data
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row['photo'];
    $event_name = $row['eventName'];
    $event_date = $row['event_date'];
    $event_venue = $row['venue'];
    $event_description = $row['e_desc'];
    $internal_participants = $row['no_students'];
    $external_participants = $row['no_faculty'];
    $resource_persons = $row['RpersonName']; 
    $key_points = $row['summary']; // Adjust field names based on your table structure
    $beneficiary = $row['beneficiary'];
    //$outcome = $row['outcome'];
    $event_coordinator = $row['CoordinatorName'];

    // Detect the image format from the binary data
    $finfo = finfo_open(FILEINFO_MIME_TYPE); // Get file info resource
    $mimeType = finfo_buffer($finfo, $imageData); // Detect the MIME type of the binary data
    finfo_close($finfo);
    
    // Determine the format based on the MIME type
    switch ($mimeType) {
        case 'image/jpeg':
            $format = 'JPG';
            break;
        case 'image/png':
            $format = 'PNG';
            break;
        case 'image/gif':
            $format = 'GIF';
            break;
        
    }
} else {
    die("No event found with the given ID.");
}

// Fetch event photos from the 'photos' table where event_id is 40
$photos = array(); // Initialize an empty array to store photo data
$sqlPhotos = "SELECT * FROM photos WHERE event_id = $event_id"; // Adjust event_id as needed
$resultPhotos = $conn->query($sqlPhotos);

if ($resultPhotos->num_rows > 0) {
    while ($photoRow = $resultPhotos->fetch_assoc()) {
        $photos[] = $photoRow['photo']; // Assuming 'photo' contains the binary data
    }
}

// Extend the TCPDF class to create a custom header and footer
class MyPDF extends TCPDF {
    public function Header() {
        $imageFileLeft = 'somaiyalogo.png';
        $imageFileRight = 'csi_kjsieit_student_s_chapter_logo.png';
        // Position the header images
        $this->Image($imageFileLeft, 10, 10, 80, 40, 'PNG');
        $this->Image($imageFileRight, 160, 10, 40, 40, 'PNG');
        // Set Y position after the header images
        $this->SetY(50); // Ensure content starts after the header images
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('times', 'I', 10);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Create new PDF document with custom header and footer
$pdf = new MyPDF('P', 'mm', 'A4');
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// Set margins to ensure the text starts below the header
$pdf->SetTopMargin(60); // Ensure enough space for the header
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(15);

// Add a page
$pdf->AddPage();

// Set font for content
$pdf->SetFont('times', 'B', 16);

// Title of the Report (Center aligned and bold)
$pdf->Cell(0, 10, 'Report of '. $event_name, 0, 1, 'C');
$pdf->Ln(15); // Add extra space below the title to ensure the image doesn't overlap

// Insert event poster image (Center align the image)
$pdf->Image('@' . $imageData, 45, 70, 120, 90, $format); // Adjust size (w, h) and position (x, y)
$pdf->Ln(100); // Provide sufficient space below the image

// Set font for event details
$pdf->SetFont('times', 'B', 12); 
$pdf->Cell(45, 6, "Name of the event:", 0, 0, 'L'); 
$pdf->SetFont('times', '', 12); 
$pdf->Cell(0, 6, $event_name, 0, 1, 'L');

$pdf->SetFont('times', 'B', 12); 
$pdf->Cell(45, 6, "Date & Time:", 0, 0, 'L');
$pdf->SetFont('times', '', 12); 
$pdf->Cell(0, 6, $event_date, 0, 1, 'L');

$pdf->Ln(8); 

// Description
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, "Description:", 0, 1, 'L');
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(0, 10, $event_description, 0, 'L');
$pdf->Ln(8);

// Objectives
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, "Objective(s):", 0, 1, 'L');
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(0, 10, "- Learn about the exciting innovations taking place in Web3.", 0, 'L');
$pdf->MultiCell(0, 10, "- Get exposure to rapidly developing digital technology.", 0, 'L');
$pdf->MultiCell(0, 10, "- How Metaverse may affect your life.", 0, 'L');
$pdf->Ln(8);

// Beneficiaries
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(45, 10, "Beneficiaries:", 0, 0, 'L');
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 10, $beneficiary, 0, 1, 'L');

// Set font for the label to bold
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(50, 6, "Internal Participants:", 0, 0, 'L');
// Set font for the value to normal
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 6, $internal_participants, 0, 1, 'L'); // Output the internal participants count

// External participants (same format as above)
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(50, 6, "External Participants:", 0, 0, 'L');
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 6, $external_participants, 0, 1, 'L'); // Output the external participants count

// Resource persons
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(50, 6, "Resource Person(s):", 0, 0, 'L');
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 6, $resource_persons, 0, 1, 'L'); // Output the resource persons names

$pdf->Ln(8);

// Key points
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(50, 6, "Key Points:", 0, 1, 'L');
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(0, 6, $key_points, 0, 'L');

// Outcomes
$pdf->Ln(8);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, "Outcomes:", 0, 1, 'L');
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(0, 6, $outcome, 0, 'L');
// $pdf->MultiCell(0, 6, "- The experts provided a clear picture of how Metaverse is evolving.", 0, 'L');

// Glimpse of the Event Title
$pdf->Ln(8);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, "Glimpse of the Event:", 0, 1, 'L');
$pdf->Ln(5); // Add some space after the title

// Loop through the photos and add them to the PDF
foreach ($photos as $index => $photoData) {
    // Detect the image format from the binary data
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $photoData);
    finfo_close($finfo);

    // Determine the format based on the MIME type
    switch ($mimeType) {
        case 'image/jpeg':
            $format = 'JPG';
            break;
        case 'image/png':
            $format = 'PNG';
            break;
        case 'image/gif':
            $format = 'GIF';
            break;
        // default:
        //     continue; // Skip unsupported formats
    }

    // Add the image to the PDF
    $pdf->Image('@' . $photoData, '', '', 60, 40, $format); // Adjust size (w, h) as needed
    $pdf->Ln(50); // Add space after each image
}

$pdf->Ln(8);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, "Event Coordinator:", 0, 1, 'L');
$pdf->SetFont('times', '', 12);
$pdf->MultiCell(0, 6, $event_coordinator, 0, 'L');


// Output the PDF
ob_end_clean(); // Clean output buffer
$pdf->Output('report.pdf', 'I');

// Close the database connection
$conn->close();
?>
