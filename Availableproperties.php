<?php
session_start();
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Available Properties</title>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>

  <body>
    <nav
      class="navbar navbar-expand-lg navbar-dark px-5 py-2 fixed-top"
      style="background-color: indigo"
      ;
    >
      <div class="container-fluid">
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
              <a class="nav-link text-white" href="userDashboard.php"
                >LAND REGISTERY</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="logout.php">LOGOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">
                <?php
              echo "Aadhar: $userId" ;
              ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex" style="margin-top: 70px">
      <div class="w-100">
        <a
          href="adduser.php"
          class="w-100 bg-dark text-white text-decoration-none"
        >
          <button
            class="w-100 bg-danger border-0 py-3 text-white font-italic"
            style="font-weight: 600"
          >
            Register Land Details
          </button>
        </a>
      </div>

      <div class="w-100">
        <a
          href="Availableproperties.php"
          class="w-100 bg-danger text-white text-decoration-none"
        >
          <button
            class="w-100 bg-secondary border-0 py-3 text-white font-italic"
            style="font-weight: 600"
          >
            Available Properties
          </button>
        </a>
      </div>

      <div class="w-100">
        <a
          href="ownerdetails.php"
          class="w-100 bg-success text-white text-decoration-none"
        >
          <button
            class="w-100 bg-warning border-0 py-3 text-white font-italic"
            style="font-weight: 600"
          >
            Owner Properties
          </button>
        </a>
      </div>
      <div class="w-100">
        <a
          href="transactiondetails.php"
          class="w-100 bg-info text-white text-decoration-none"
        >
          <button
            class="w-100 bg-info border-0 py-3 text-white font-italic"
            style="font-weight: 600"
          >
            Transaction Details
          </button>
        </a>
      </div>
    </div>

    <!-- <div class="p-2 text-center font-italic "
     style="font-size:20px;font-weight: 500;color:white;background-color: rgb(8 47 73);">Available Properties</div> -->
    <div class="overflow-auto">
      <table id="usersTable " border="2">
        <thead>
          <tr>
            <th class="pl-3">Name</th>
            <th >Email</th>
            <th>Adhar</th>
            <th>Phone</th>
            <th>LandID</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Document</th>
            <th>Status</th>
            <th>Email</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody id="usersTableBody">
          <!-- User details will be added here dynamically -->
        </tbody>
      </table>
    </div>
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
    account = accounts[0];}
             
    // Non-DApp browsers
    else {
    alert("Non-Ethereum browser detected. Please install MetaMask");
    }
});

// Get ALL USERS

async function AllUsers()
{
    // Initialize the contract instance
    const contract = new web3.eth.Contract(abi, contractAddress, {from: account,});
    const usersTableBody = document.getElementById("usersTableBody");
    usersTableBody.innerHTML = ""; // Clear existing table rows

    // Call the smart contract to get all users
    const allUsers = await contract.methods.getAllUsers().call();          
    // Filter users with Aadhar number 1234567890
	// const filteredUsers = allUsers.filter((user) => user.adhar !== "10");
              
    // Iterate over each user and add them to the table
	allUsers.forEach((user) => {
    const row = document.createElement("tr");

	// Add user details to the row
	row.innerHTML = `
                  <td>${user.name}</td>
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
                  <td> <a class="btn btn-primary " href="mailto:>${user.email}?subject=
                  Mail from Land Registry Using Blockchain to Purchase your land">Send</a></td>
                  
	<td><button type="button" class="btn btn-danger" data-toggle="modal" 
	data-target="#exampleModal" data-whatever="@fat">Transfer</button></td>
	<div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog float-right" role="document" style="width: 30%">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Transfer Money</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div id="alertContainer"></div>
              <div class="form-group my-1">
                <input
                  type="text"
                  id="seller_landid"
                  class="form-control"
                  placeholder="Enter Seller LandID"
                />
              </div>
              <div class="form-group my-1">
                <input
                  type="text"
                  id="buyer_landid"
                  class="form-control"
                  placeholder="Enter Buyer LandID"
                />
              </div>
              <div class="form-group my-1">
                <input
                  type="text"
                  id="seller_address"
                  class="form-control"
                  placeholder="Enter Receiver's Address"
                />
              </div>
              <div class="form-group my-1">
                <input
                  type="number"
                  id="amount"
                  class="form-control"
                  placeholder="Enter Amount"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              onclick="TransferAmount()"
              class="btn btn-success"
            >
              Send
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>`;

    // Append the row to the table body
    usersTableBody.appendChild(row);});
}


// Trnasfer Amount
async function TransferAmount()
{
const sellers_landid = document.getElementById("seller_landid").value;
const buyers_landid = document.getElementById("buyer_landid").value;
const sellers_address = document.getElementById("seller_address").value;
const amount = document.getElementById("amount").value;

// Initialize the contract instance
const contract = new web3.eth.Contract(abi, contractAddress, {
    from: account,
});

// Fetch all users from the contract
const allUsers = await contract.methods.getAllUsers().call();
let sellerlandid="";
let buyerlandid= "";
let STATUS=0;
for (let i = 0; i < allUsers.length; i++) {
	if (allUsers[i].landID=== sellers_landid) {
        if (allUsers[i].status === "Not_Approved" || allUsers[i].status === "Rejected_by_govt") {
            STATUS = 1;
            break;
        }
    }
    for (let j = 0; j < allUsers[i].length; j++) {
		
        if (sellers_landid === allUsers[i][j]) {
            sellerlandid = allUsers[i][j];
        }
        if (buyers_landid=== allUsers[i][j]) {
            buyerlandid = allUsers[i][j];
        }
    }
}

if(STATUS==1)
{
	document.getElementById("alertContainer").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show">
             Land is not approved by Govt!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
		return;

}

else if (sellers_landid === "" || buyers_landid=== "" || sellers_address === "" || amount === "") {
    document.getElementById("alertContainer").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show">
            All fields are required!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
		return;
} 

else if (sellerlandid==="") {
    document.getElementById("alertContainer").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show">
            Seller's LandID does not exist!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
		return;
} else if (buyerlandid==="") {
    document.getElementById("alertContainer").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show">
            Buyer's LandID does not exist!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
		return;
}

   // Send ETHER
let weiValue;
let txHash;
try {          
    // Convert Ether to Wei manually (1 ETH = 10^18 Wei)
    weiValue = BigInt(parseFloat(amount) * 1e18);

    txHash = await ethereum.request({
        method: "eth_sendTransaction",
        params: [
            {
                from: account, // Use the sender address
                to: sellers_address,
                value: '0x' + weiValue.toString(16), // Use the converted Wei value
            }
        ]
    });
	 // Obtain current timestamp upon successful transaction
	 const timestamp = new Date().toLocaleString('en-US', { hour12: false });

    // Metamask will prompt the user to sign the transaction
    try {
        const result = await contract.methods
            .sendAmount(sellers_landid, buyers_landid, sellers_address, account, weiValue, txHash,timestamp)
            .send();

        // Check transaction status
        if (result.status === true) {
            document.getElementById("alertContainer").innerHTML = `
            <div class="alert alert-success alert-dismissible fade show">
                Amount transferred Successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        }
    } catch (error) {
        document.getElementById("alertContainer").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show">
            ${error.message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
        alert(error.message);
    }
} catch (error) {
    console.error(error);
}

}

// Load all users when the page loads
    window.addEventListener("load", async () => {
    AllUsers(); });
</script>
</body>
</html>
