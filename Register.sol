// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract UserRegistry {
    address public owner;
    
    struct User {
        string name;
        string email;
        string adhar;
        string phone;
        string landID;
        string country;
        string state;
        string city;
        uint256 pincode;
        string ipfsHash;
        string status;
    }
    
    struct UserInfo {
        string name;
        string email;
        string adhar;
        string phone;
        string landID;
        string ipfsHash;
        string userAddress; // Changed from "address" to "userAddress"
    }

    struct TransactionDetails {
        UserInfo seller;
        string buyer_landID;
        string buyer_address;
        uint256 amount;
        string transaction_status;
        string transaction_hash;
        string timestamp;
    }

    struct TransactionDetail {
        string sellerName;
        string sellerEmail;
        string sellerPhone;
        string sellerAdhar;
        string sellerLandId;
        string selleripfsHash;
        string sellerAddress;
        string buyerName;
        string buyerEmail;
        string buyerPhone;
        string buyerAdhar;
        string buyerLandId;
        string buyeripfsHash;
        string buyerAddress;
        uint256 amount;
        string transaction_hash;
        string transactionStatus;
        string timestamp;
        string ownership_status;
    }

    mapping(string => User) private usersByLandID;
    string[] private userLandIDs;
    mapping(string => string) public ownershipStatus; // Mapping of seller LandID to ownership status
    mapping(uint256 => TransactionDetails) public transactions;
    uint256 public transactionCount;

    constructor() {
        owner = msg.sender;
    }

    modifier onlyOwner() {
        require(msg.sender == owner, "Only owner can call this function");
        _;
    }

    function addUser(
        string memory _name,
        string memory _email,
        string memory _adhar,
        string memory _phone,
        string memory _landID,
        string memory _country,
        string memory _state,
        string memory _city,
        uint256 _pincode,
        string memory _ipfsHash
    ) public {
        require(bytes(usersByLandID[_landID].landID).length == 0, "Land ID already exists");
        usersByLandID[_landID] = User(_name, _email, _adhar, _phone, _landID, _country, _state, _city, _pincode, _ipfsHash, "Not_Approved");
        userLandIDs.push(_landID);
    }

    function getAllUsers() public view returns (User[] memory) {
        User[] memory allusers = new User[](userLandIDs.length);
        for (uint256 i = 0; i < userLandIDs.length; i++) {
            allusers[i] = usersByLandID[userLandIDs[i]];
        }
        return allusers;
    }

    function rejectUser(string memory _landID) public onlyOwner {
        require(bytes(usersByLandID[_landID].landID).length != 0, "User does not exist");
        usersByLandID[_landID].status = "Rejected_by_govt";
    }

    function validateUser(string memory _landID) public onlyOwner {
        require(bytes(usersByLandID[_landID].landID).length != 0, "User does not exist");
        usersByLandID[_landID].status = "Approved";
    }

    function sendAmount(
        string memory _sellerLandID,
        string memory _buyerLandID,
        string memory _sellerAddress,
        string memory _buyerAddress,
        uint256 _amount,
        string memory _transHash,
        string memory _timestamp
    ) public {
        require(bytes(usersByLandID[_sellerLandID].landID).length != 0, "Seller does not exist");
        require(bytes(usersByLandID[_buyerLandID].landID).length != 0, "Buyer does not exist");

        string memory status = "Success"; // assuming successful transfer

        transactionCount++;

        transactions[transactionCount] = TransactionDetails({
            seller: UserInfo({
                name: usersByLandID[_sellerLandID].name,
                email: usersByLandID[_sellerLandID].email,
                adhar: usersByLandID[_sellerLandID].adhar,
                phone: usersByLandID[_sellerLandID].phone,
                landID: _sellerLandID,
                ipfsHash: usersByLandID[_sellerLandID].ipfsHash,
                userAddress: _sellerAddress
            }),
            buyer_landID: _buyerLandID,
            buyer_address: _buyerAddress,
            amount: _amount,
            transaction_status: status,
            transaction_hash: _transHash,
            timestamp: _timestamp
        });
    }

    function fetchDetails() public view returns (TransactionDetail[] memory details) {
        details = new TransactionDetail[](transactionCount);

        for (uint256 i = 1; i <= transactionCount; i++) {
            TransactionDetails memory txDetails = transactions[i];

            // Fetch ownership status directly from mapping
            string memory status = ownershipStatus[txDetails.seller.landID];

            // Set default ownership status to "Not_transferred" if it is not set
            if (bytes(status).length == 0) {
                status = "Not_transferred";
            }

            details[i - 1] = TransactionDetail({
                sellerName: txDetails.seller.name,
                sellerEmail: txDetails.seller.email,
                sellerPhone: txDetails.seller.phone,
                sellerAdhar: txDetails.seller.adhar,
                sellerLandId: txDetails.seller.landID,
                selleripfsHash: txDetails.seller.ipfsHash,
                sellerAddress: txDetails.seller.userAddress,
                buyerName:usersByLandID[txDetails.buyer_landID].name, 
                buyerEmail: usersByLandID[txDetails.buyer_landID].email, 
                buyerPhone:usersByLandID[txDetails.buyer_landID].phone,  
                buyerAdhar:usersByLandID[txDetails.buyer_landID].adhar,  
                buyerLandId: txDetails.buyer_landID,
                buyeripfsHash: usersByLandID[txDetails.buyer_landID].ipfsHash,
                buyerAddress: txDetails.buyer_address,
                amount: txDetails.amount,
                transaction_hash: txDetails.transaction_hash,
                transactionStatus: txDetails.transaction_status,
                timestamp: txDetails.timestamp,
                ownership_status: status 
            });
        }
    }

    function changeOwnership(string memory _sellerLandID, string memory _buyerLandID) public onlyOwner {
        require(bytes(usersByLandID[_sellerLandID].landID).length != 0, "Seller does not exist");
        require(bytes(usersByLandID[_buyerLandID].landID).length != 0, "Buyer does not exist");

        ownershipStatus[_sellerLandID] = "Transferred";

        usersByLandID[_sellerLandID] = usersByLandID[_buyerLandID];
        usersByLandID[_buyerLandID].landID = _sellerLandID;
        usersByLandID[_buyerLandID].status = "Approved";
        usersByLandID[_buyerLandID].ipfsHash = usersByLandID[_sellerLandID].ipfsHash;
    }
}
