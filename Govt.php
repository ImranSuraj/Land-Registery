
<?php
session_start();
$govtId = $_SESSION['govt_id'];
require('connection.php');

// Check if user is not logged in
if (!isset($_SESSION['govt_id'])) {

    // Redirect to the login page
    header("Location: govtlogin.php");
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Govt Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins:wght@200&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./style.css">

  </head>
  
  </style>
  <body >

  <nav class=" navbar navbar-expand-lg navbar-dark  px-5 py-2  fixed-top "
  style="background-color:indigo;">
      
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php">LAND REGISTERY</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="govtlogout.php">LOGOUT</a>
            </li>
			<li class="nav-item">
              <a class="nav-link text-white" href="govttransactiondetails.php">TRANSACTIONS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">
              <?php
              echo "ID: $govtId" ;
              ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="overflow-auto" style="margin-top:70px"> 
    <table id="usersTable" border="2" >
      <thead>
        <tr>
          <th class="pl-3">Name</th>
          <th>Email</th>
          <th>Adhar</th>
          <th>Phone</th>
          <th>LandId</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
          <th>Pincode</th>
          <th>Document</th>
          <th>Status</th>
          <th class="text-center" >Actions</th>
        </tr>
      </thead>
      <tbody id="usersTableBody">
        <!-- User details will be added here dynamically -->
      </tbody>
    </table>
    <div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.5.2/web3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@1.3.4/dist/web3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      const contractAddress = "0x6cDDd073a7641304aBCc3eAC5F2e03879d9d0E8D";
      const abi =[
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_email",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_adhar",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_phone",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_country",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_state",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_city",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_pincode",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_ipfsHash",
				"type": "string"
			}
		],
		"name": "addUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_sellerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerLandID",
				"type": "string"
			}
		],
		"name": "changeOwnership",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			}
		],
		"name": "rejectUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_sellerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerLandID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_sellerAddress",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_buyerAddress",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_amount",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_transHash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_timestamp",
				"type": "string"
			}
		],
		"name": "sendAmount",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_landID",
				"type": "string"
			}
		],
		"name": "validateUser",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "fetchDetails",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "sellerName",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerEmail",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerPhone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerAdhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerLandId",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "selleripfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "sellerAddress",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerName",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerEmail",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerPhone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerAdhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerLandId",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyeripfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "buyerAddress",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "amount",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "transaction_hash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "transactionStatus",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "timestamp",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "ownership_status",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.TransactionDetail[]",
				"name": "details",
				"type": "tuple[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getAllUsers",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "name",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "email",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "adhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "phone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "landID",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "country",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "state",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "city",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "pincode",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "ipfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "status",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.User[]",
				"name": "",
				"type": "tuple[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "owner",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"name": "ownershipStatus",
		"outputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "transactionCount",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "transactions",
		"outputs": [
			{
				"components": [
					{
						"internalType": "string",
						"name": "name",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "email",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "adhar",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "phone",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "landID",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "ipfsHash",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "userAddress",
						"type": "string"
					}
				],
				"internalType": "struct UserRegistry.UserInfo",
				"name": "seller",
				"type": "tuple"
			},
			{
				"internalType": "string",
				"name": "buyer_landID",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "buyer_address",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "amount",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "transaction_status",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "transaction_hash",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "timestamp",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
]
	  var account;
      window.addEventListener("load", async () => {
        // Modern DApp browsers
        if (window.ethereum) {
          window.web3 = new Web3(ethereum);

          // To prevent the page reloading when the MetaMask network changes
          ethereum.autoRefreshOnNetworkChange = false;

          // To Capture the account details from MetaMask
          const accounts = await ethereum.enable();
          account = accounts[0];
        }

        // Non-DApp browsers
        else {
          alert("Non-Ethereum browser detected. Please install MetaMask");
        }
      });

      async function AllUsers() {
        // Initialize the contract instance
        const contract = new web3.eth.Contract(abi, contractAddress, {
          from: account,
        });
        const usersTableBody = document.getElementById("usersTableBody");
        usersTableBody.innerHTML = ""; // Clear existing table rows

        // Call the smart contract to get all users
        const allUsers = await contract.methods.getAllUsers().call();

        // Iterate over each user and add them to the table
        allUsers.forEach((user) => {
          const row = document.createElement("tr");

          // Add user details to the row
          row.innerHTML = `
            <td >${user.name}</td>
            <td>${user.email}</td>
            <td>${user.adhar}</td>
            <td>${user.phone}</td>
            <td>${user.landID}</td>
            <td>${user.country}</td>
            <td>${user.state}</td>
            <td>${user.city}</td>
            <td>${user.pincode}</td>
            <td>
            <a href="https://gateway.pinata.cloud/ipfs/${user.ipfsHash}" download
            style="font-size:14px"
            >
            Download
           </a>
            </td>
			<td>${user.status}</td>

            <td class="d-flex gap-2 ">
                <a class="btn btn-primary px-2 py-1" href="mailto:>${user.email}?subject=
                Mail from Land Registry Using Blockchain to know about your Land Registery">Email</a>
                <button class="btn bg-warning mr-2 px-2 py-1" onclick="ValidateUser('${user.landID}')">Accept</button>
                <button class="btn bg-danger px-2 py-1"  onclick="Rejectuser('${user.landID}')">Reject</button>
                
        `;

          // Append the row to the table body
          usersTableBody.appendChild(row);
        });
      }

      // Function to approve a user
      async function ValidateUser(landID) {
        // Initialize the contract instance
        const contract = new web3.eth.Contract(abi, contractAddress, {
          from: account,
        });
        try {
          await contract.methods.validateUser(landID).send();
          alert("Land approved successfully!");
          // Refresh the user table after approval
          AllUsers();
        } catch (error) {
          console.error("Error:", error);
          alert("Failed to approve user!");
        }
      }

      // Function to mark a user as not approved
      async function Rejectuser(landID) {
        // Initialize the contract instance
        const contract = new web3.eth.Contract(abi, contractAddress, {
          from: account,
        });
        try {
          await contract.methods.RejectUser(landID).send();
          alert("Approval rejected successfully!");
          // Refresh the user table after marking as not approved
          AllUsers();
        } catch (error) {
          console.error("Error:", error);
          alert("Failed to reject user approval!");
        }
      }
      // Load all users when the page loads
      window.addEventListener("load", async () => {
        AllUsers();
      });
    </script>
  </body>
</html>
